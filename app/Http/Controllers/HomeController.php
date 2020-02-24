<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Service;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Session;
use Braintree_Transaction;
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
        $apartments = Apartment::orderBy('id', 'DESC') -> get();
        $services = Service::all();

        return view('home', compact('apartments','services'));
    }

    public function userApartments()
    {
        $userId = auth()->user()->id;
        //$apartments = Apartment::find(auth()->user()->id);
        $user = User::findOrFail($userId);
        $apartments = $user -> apartments;
        // $messages = $apartments -> messages;
        
        // dd($apartments);
        return view('userApartments', compact('apartments'));
    }


    public function showApartments($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment -> increment("view");
        //  dd($apartment);
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
            "address" => 'required|string',
            "description" => 'nullable|string',
            "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "roomNum" => 'required|numeric',
            "bedNum" => 'required|numeric',
            "mQ" => 'required|numeric',
            "wcNum" => 'required|numeric',
            "visible" => 'nullable|numeric',
            "latitude" => 'nullable|numeric',
            "longitude" => 'nullable|numeric',
            "services"=>'nullable|array'
        ]);
        
        
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
            "address" => 'required|string',
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
        if (!$request -> file('image') == 0) {
            $file = $request -> file('image');
            $filename = $file -> getClientOriginalName();
            $file -> move('images',$filename);
            $newUserData = [
                'image'=>$filename
            ];
        }
        
        // $data=$request->all();
        // dd($data);
        $apartment=Apartment::findOrFail($id);
        if(isset($data["services"])){
            $services=Service::find($data['services']);
        }else{
            $services=[];
        }
        $apartment->services()->sync($services);
        $apartment->update($data);
        if (!$request -> file('image') == 0) {
            $apartment -> update($newUserData);
        }
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


    public function searchRadiusApartment(Request $request){
        $services = Service::all();
        $data = $request ->all();
        $address= $request->get('address');
        $radius= $request->get('radius');
        $lat = $request->get('latitude');
        $lon = $request->get('longitude');
        $roomNum = $request->get('roomNum');
        $bedNum = $request->get('bedNum');
        $servicesQuery = $request -> validate(["services"=>'nullable|array']);

        $toFilterApartments = Apartment::select('apartments.*')
        // $apartments = Apartment::select('apartments.*')
        ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance', [$lat, $lon, $lat])
        ->havingRaw("distance < ?", [$radius])
        ->orderBy('distance', 'ASC')->get();
        
        $apartments=[];
        foreach ($toFilterApartments as $toFilterApartment) {
            if (( $toFilterApartment->roomNum >= $roomNum)&&($toFilterApartment->bedNum >= $bedNum)) {
                if (!$servicesQuery == 0) {
                    $servicesQuery = $request -> get('services');
                    
                        $serviceFilter=[];
                        foreach ($toFilterApartment-> services as $x) {
                            $serviceFilter[]=$x -> id;
                        }
                        if (count(array_intersect($servicesQuery, $serviceFilter)) == count($servicesQuery)) {
                            $apartments[]=$toFilterApartment;
                            // echo ' esiste';
                        }
                
                        // </script>";
                }else {
                    $apartments[]=$toFilterApartment;   
                }
            }
        }
        return view('crud.radius-apartment', compact('apartments','services','address'));
    }

    public function storeMessage(Request $request, $id) {
        $data = $request -> validate ([
            "email" => 'required|string',
            "title" => 'required|string',
            "body" => 'required|string'
        ]);

        $message = Message::make($data);
        $message -> apartment_id = $id;

        $message -> save();
        //Session::flash('msg', 'Thanks');

        Session::flash('msg', 'Email inviata'); 
        Session::flash('alert-class', 'alert-danger');

        return redirect() -> route('apartmentShow', compact('id'));
    }

    public function chartsApartment($id){
        $apartment = Apartment::findOrFail($id);
        
        return view('charts', compact('apartment'));

    }

    public function generalChartsApartments(){
        $userId = auth()->user()->id;
        // dd($userId);    
        $user = User::findOrFail($userId);
        $apartments = $user-> apartments;
        $messagesCount= [];
        foreach ($apartments as $apartment) {
            $messagesCount[]= $apartment -> messages ->count();
        }
        // dd($messagesCount);
        // dd($apartments);

        return view('generalCharts', compact('apartments','messagesCount'));
    }

    // sponsor apartment RF8
    public function sponsorApartment($id){
        $apartment = Apartment::findOrFail($id);
        // dd($apartment);
        return view('crud.sponsorApartment' ,compact('apartment'));
    }

    public function processApartment(Request $request){
        //dd($request);
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        //dd($request['prezzo']);
        
        //$option = $request->prezzo;
        //dd($option);

        $status = Braintree_Transaction::sale([
        'amount' => '10.00',
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);
    
        return response()->json($status);
    }
}
