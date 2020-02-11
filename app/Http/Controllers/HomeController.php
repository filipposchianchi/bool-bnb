<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Service;
use App\User;
use Illuminate\Http\Request;

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
            "address" => 'required|string',
            "description" => 'nullable|string',
            "img" => 'nullable|string',
            "roomNum" => 'required|numeric',
            "bedNum" => 'required|numeric',
            "mQ" => 'required|numeric',
            "wcNum" => 'required|numeric',
            "services"=>'nullable|array'
        ]);
        $data=$request->all();
        // dd($data);
        $apartment = Apartment::make($data);
        if(isset($data["services"])){
            $services=Service::find($data['services']);
        }else{
            $services=[];
        }
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        $apartment -> user() -> associate($user);
        $apartment -> save();
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
            "img" => 'nullable|string',
            "roomNum" => 'required|numeric',
            "bedNum" => 'required|numeric',
            "mQ" => 'required|numeric',
            "wcNum" => 'required|numeric',
            "services"=>'nullable|array'
        ]);
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
        return redirect() -> route('user');
    }

    public function deleteApartment($id){
        $apartment=Apartment::findOrFail($id);
        $services=$apartment-> services;
        $apartment->services()->detach($services);
        $apartment->delete();
        return redirect() -> route('user');
    }
}
