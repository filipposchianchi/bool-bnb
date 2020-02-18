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

        return view('home', compact('apartments'));
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


    public function searchApartment(Request $request){
        // $data = $request -> validate([
        //     "address" => 'nullable|string',
        // ]);
        // dd($data['address']);
        $lat = $request->get('latitude');;// latitude of centre of bounding circle in degrees
        $lon = $request->get('longitude');// longitude of centre of bounding circle in degrees
        $rad = 20; // radius of bounding circle in kilometers
        $R = 6371; // earth's mean radius, km

        $maxLat = $lat + rad2deg($rad/$R);
        $minLat = $lat - rad2deg($rad/$R);
        $maxLon = $lon + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
        $minLon = $lon - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));

        $apartments = DB::select(
            'SELECT * FROM
                 (SELECT id, title, description, image,  (' . $R . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                 cos(radians(longitude) - radians(' . $lon . ')) +
                 sin(radians(' . $lat . ')) * sin(radians(latitude))))
                 AS distance
                 FROM apartments) AS distances
             WHERE distance < ' . $rad . '
             ORDER BY distance
             OFFSET 0
             LIMIT 20;
         ');

         dd($apartments);
        return view('search-result', ['apartments' => $apartments]);
    }

    public function storeMessage(Request $request, $id) {
        $data = $request -> validate ([
            "email" => 'required|string',
            "title" => 'required|string',
            "body" => 'required|string'
        ]);
        //dd($data);
        //$data=$request->all();
        $message = Message::make($data);
        $message -> apartment_id = $id;

        
        $message -> save();
        //Session::flash('msg', 'Thanks');


        Session::flash('msg', 'Email inviata'); 
        Session::flash('alert-class', 'alert-danger');

        return redirect() -> route('apartmentShow', compact('id'));


    }
}
