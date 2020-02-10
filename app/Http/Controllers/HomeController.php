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
        $allApartments = Apartment::all();
        foreach ($allApartment as $apartment) {
            # code...
        }
        // dd($apartments);
        return view('home', compact('apartments'));
    }
    public function userApartments()
    {
        $userId = auth()->user()->id;
        //$apartments = Apartment::find(auth()->user()->id);
        $user = User::findOrFail($userId);
        $apartments = $user -> apartments;
        // dd($apartments);
        return view('userApartments', compact('apartments'));
    }
}
