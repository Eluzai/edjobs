<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $chkUser = User::where('email', '=', $request->input('email'))->first();
        if ($chkUser) {
            return 1;
        }else{
            $user = new User;
            $user->firstname = $request->fname;
            $user->lastname = $request->lname;
            $user->email = $request->email;
            $user->image = 'default';
            if ($request->has('subscribe')) {
                $user->subscribe = 'YES';
            }else {
                $user->subscribe = 'NO';
            }
            $user->password = bcrypt($request->password);
            $user->save();
            auth()->login($user);
        }
    }

    //show login form
    public function index(){
        return view('users.page');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in');
        }
        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
        
    }

   

}
