<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //
    public function index()
    {
        $listings = Listing::Paginate(10);
        //$listings = Listing::all();
        return view('listings.listings',['listings'=>$listings]);
    }

    //show job details 
    public function detail($listing){
        $listing = Listing::find($listing);
        $company = $listing->company;
        return view('listings.details',['listing' => $listing,'company' => $company]);
    }

    //
    public function jobpost(){
        return view('listings.jobpost');
    }

}
