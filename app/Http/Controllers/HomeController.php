<?php

namespace App\Http\Controllers;
use App\Apartment;
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


    public function createApartments()
    {
        
        return view('crud.create-apartment');
    }

    public function storeApartments(Request $request, $id)
    {
        
        $validatedData = $request -> validated();

        $apartment = Apartment::make($validatedData);
        
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        
        $apartment -> user() -> associate($user);
        $apartment -> save();


        return redirect() -> route('home');    
    
    }


}
