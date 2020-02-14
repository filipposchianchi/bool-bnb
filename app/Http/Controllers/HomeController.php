<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apartments = Apartment::all();
        // $apartments = [];
        // foreach ($allAp  as $apartment) {
        //     if ($apartment-> sponsored==1) {
        //         array_push($apartments, 'apartment');
        //     }
        // };
        // dd($apartments);
        return view('home', compact('apartments'));
    }

    public function userApartments()
    {
        $userId = auth()->user()->id;
        //$apartments = Apartment::find(auth()->user()->id);
        $user = User::findOrFail($userId);
        $apartments = $user -> apartments;
        $apartmentCount = $apartments->count();
        
        // dd($apartments);
        return view('userApartments', compact('apartments', 'apartmentCount'));
    }


    public function showApartments($id)
    {
        $apartment = Apartment::findOrFail($id);
        // dd($apartments);
        return view('crud.show-apartment', compact('apartment'));
    }
    public function createApartment(){
        $services = Service::all();
        return view('crud.create-apartment', compact('services'));
    }

    public function storeApartments(Request $request)
    {
        $data = $request -> validate ([
            "title" => 'required|string',
            "countryCode" => 'required|string',
            "streetNumber" => 'required|numeric',
            "streetName" => 'required|string',
            "municipality" => 'required|string',
            "postalCode" => 'required|string',
            "description" => 'nullable|string',
            "image" => 'nullable||image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "roomNum" => 'required|numeric',
            "bedNum" => 'required|numeric',
            "mQ" => 'required|numeric',
            "wcNum" => 'required|numeric',
            "visible" => 'nullable|numeric',
            "latitude" => 'nullable|numeric',
            "longitude" => 'nullable|numeric',
            "services"=>'nullable|array'
        ]);

        // inserire dati per chiamata ajax tomtom
        $client = new Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/structuredGeocode.json?',[
            'query'=> [
                'countryCode' => $data['countryCode'],
                'limit' => '1',
                'streetNumber' => $data['streetNumber'],
                'streetName' => $data['streetName'],
                'municipality' => $data['municipality'],
                'postalCode' => $data['postalCode'],
                'key' => 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG'],
            ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        //prendere quei dati e mettere long e lat
        $position = json_decode( $body, true );
        $latitude = $position['results']['0']['position']['lat'];
        $longitude = $position['results']['0']['position']['lon'];
        
        
        $data=$request->all();
        // dd($data);
        $file = $request -> file('image');
        $filename = $file -> getClientOriginalName();
        $file -> move('images',$filename);
        $newUserData = [
            'image'=>$filename
        ];
        // dd($filename);
        $apartment = Apartment::make($data);
        
        //salva nel db lat e long
        $apartment -> latitude = $latitude;
        $apartment -> longitude = $longitude;
        
        
        if(isset($data["services"])){
            $services=Service::find($data['services']);
        }else{
            $services=[];
        }
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        $apartment -> user() -> associate($user);
        $apartment -> save();
        $apartment -> update($newUserData);
        $apartment->services()->sync($services);


        return redirect() -> route('user');    
    
    }

    public function editApartment($id){
        $services=Service::all();
        $apartment=Apartment::findOrFail($id);
        return view('crud.edit-apartment', compact('services','apartment'));
    }

    public function updateApartment(Request $request, $id){
        $data = $request -> validate ([
            "title" => 'required|string',
            "countryCode" => 'required|string',
            "streetNumber" => 'required|numeric',
            "streetName" => 'required|string',
            "municipality" => 'required|string',
            "postalCode" => 'required|string',
            "description" => 'nullable|string',
            "image" => 'nullable||image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "roomNum" => 'required|numeric',
            "bedNum" => 'required|numeric',
            "mQ" => 'required|numeric',
            "wcNum" => 'required|numeric',
            "visible" => 'required|numeric',
            "latitude" => 'nullable|numeric',
            "longitude" => 'nullable|numeric',
            "services"=>'nullable|array'
        ]);
        $file = $request -> file('image');
        $filename = $file -> getClientOriginalName();
        $file -> move('images',$filename);
        $newUserData = [
            'image'=>$filename
        ];
        $client = new Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/structuredGeocode.json?',[
            'query'=> [
                'countryCode' => $data['countryCode'],
                'limit' => '1',
                'streetNumber' => $data['streetNumber'],
                'streetName' => $data['streetName'],
                'municipality' => $data['municipality'],
                'postalCode' => $data['postalCode'],
                'key' => 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG'],
            ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        //prendere quei dati e mettere long e lat
        $position = json_decode( $body, true );
        $latitude = $position['results']['0']['position']['lat'];
        $longitude = $position['results']['0']['position']['lon'];
        // $data=$request->all();
        // dd($data);
        $apartment=Apartment::findOrFail($id);
        $apartment -> latitude = $latitude;
        $apartment -> longitude = $longitude;
        if(isset($data["services"])){
            $services=Service::find($data['services']);
        }else{
            $services=[];
        }
        $apartment->services()->sync($services);
        $apartment->update($data);
        $apartment -> update($newUserData);
        return redirect() -> route('user');
    }

    public function deleteApartment($id){
        
        $apartment=Apartment::findOrFail($id);
        $services=$apartment-> services;
        $messages=$apartment-> messages;
        $promos = $apartment -> promos;

        $apartment->services()->detach($services);
        $apartment->messages()->delete();
        $apartment->promos()->detach($promos);

        $apartment->delete();
        return redirect() -> route('user');
    }

    public function searchAddress($id){

        $apartment=Apartment::findOrFail($id);

        $countryApartment = $apartment -> countryCode;

        dd($countryApartment);


        $client = new Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/structuredGeocode.json?',[
            'query'=> [
                'countryCode' => 'IT',
                'limit' => '1',
                'streetNumber' => '223',
                'streetName' => 'via della pineta',
                'municipality' => 'CAGLIARI',
                'postalCode' => '09126',
                'key' => 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG'],
            ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

    
        $position = json_decode( $body, true );

        dd($position['results']['0']['position']);

        
        // foreach($obj2['results'] as $key => $position) {
        //     dd($position);
        // }
        // dd($result);
    }
    public function searchApartment(Request $request){
        $search = $request->get('search');
        $apartments = DB::table('apartments')->where('municipality', 'like', '%'.$search.'%') ->paginate(7);
        // dd($search);
        //controllo se -> 
        $client = new Client();
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/structuredGeocode.json?',[
            'query'=> [
                'countryCode' => 'IT',
                'municipality' => $search,
                'radius'=> 20000,
                'key' => 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG'],
            'database'=>[
                'apartments'
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        // dd($position['results']['0']['position']);
        // dd($body);ss
        return view('search-result', ['apartments' => $apartments]);
    }
}
