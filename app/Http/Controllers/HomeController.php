<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class HomeController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        //$listings = Listing::orderby('updated_at','Desc')->get();
        $listings = Listing::all();
        //dd($listings);
        return view('index',['listings'=>$listings]);
    } 
}
