<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Dotenv\Parser\Value;

class UserController extends Controller
{
    //show sign up form
    public function create(){
        return view('users.signup');
    }
    //Store form fields to database
    public function store(Request $request){
        $formFields = $request->validate([
            'fname' => ['required','min:2'],
            'lname' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => ['required','confirmed', 'min:6'] 
        ]);
        
        // if ($request->get('image')=='') {
        //     $formFields['image'] = 'default_image';
        // }
        // if ($request->get('subscribe')==NULL) {
        //     $formFields['subscribe'] = 'NO';
        // }else {
        //     $formFields['subscribe'] = 'YES';
        // }

        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        //create user
        User::create($formFields);
        //$user = User::create($formFields);
        //Login new user
        //auth()->login($user);
        //return dd($formFields);
    }

    //show login form
    public function login(){
        return view('users.login');
    }

}
