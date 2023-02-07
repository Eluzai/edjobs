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
            return 0;
        }else{
            $user = new User;
            $user->firstname = $request->fname;
            $user->lastname = $request->lname;
            $user->email = $request->email;
            $user->image = 'default';
            if ($request->has('subscribe')) {
                $user->subscribe = 'subscribed';
            }else {
                $user->subscribe = 'unsubscribed';
            }
            $user->password = bcrypt($request->password);
            $user->save();
            auth()->login($user);
            return 1;
        }
    }

    //show login form
    public function index(){
        return view('users.page');
    }

    //show login form
    public function login(){
        return view('users.signin');
    }

    //Authenticate User
    public function authenticate(Request $request){
        if (auth()->attempt(array('email'=>$request->email, 'password'=>$request->password))) {
            //$request->session()->regenerate();
            return response()->json([ [1] ]);
        } else {
            return response()->json([ [0] ]);
        }
        
    }

    public function logout(){
        auth()->logout();
        return redirect('/signin');
    }
}
