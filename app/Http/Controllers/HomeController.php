<?php

namespace App\Http\Controllers;
use App\Apartment;
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
        // dd($apartments);
        return view('home', compact('apartments'));
    }
    public function userApartments()
    {
        $userId = auth()->user()->id;
        // $apartments = Apartment::find(auth()->user()->id);
        $apartments = Apartment::findOrFail($userId);
        $apartments = $user -> apartments;
        dd($apartments);
        // return view('userApartments', compact('apartments'));
    }
}
