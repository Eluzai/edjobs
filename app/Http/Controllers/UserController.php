<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Company;
use Dotenv\Parser\Value;
use App\Mail;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //show sign up form
    public function create(User $user){
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
            $user->image = 'storage/profile_images/placeholder.png';
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
    public function login(){
        return view('users.signin');
    }

    //Authenticate User
    public function authenticate(Request $request, User $user){
        if (auth()->attempt(array('email'=>$request->email, 'password'=>$request->password))) {
            $request->session()->regenerate();
            return response()->json([ [1] ]);
        } else {
            return response()->json([ [0] ]);
        }
        
    }

    //show user dashboard 
    public function dashboard(){
        $listings = Listing::where();
        $companys = Company::all();
        return view('users.dashboard',[
            'listings'=>$listings,
            'companys'=>$companys
        ]);
    }

    //show user dashboard 
    public function edit(User $user){
        return view('users.editUser',[
            'user' => $user
        ]);
    }

    //update user data
    public function update(Request $request, User $user){
        //dd($request->password);
        if ($user->id != auth()->user()->id) {
            abort('403','Unauthorized Action');
        }
        $formFields = array(
            'firstname' => $request->fname,
            'lastname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        );
        # check if the request has profile image
        if ($request->hasFile('formFile')) {
            $file = $request->file('formFile');
            $ext = $file->getClientOriginalExtension();
            $allow_ext = array('jpg','jpeg','png');
            if (in_array($ext, $allow_ext)) {
                $new_name = strtolower('user'.$user->id.'.'.$ext);
                $imagePath = 'storage/app/pulic/profile_image'.$new_name;
                # check whether the image exists in the directory
                if (File::exists($imagePath)) {
                    # delete image
                    File::delete($imagePath);
                } else {
                    $request->file('formFile')->storeAs('public/profile_images', $new_name);
                    $formFields['image'] = 'storage/profile_images/'.$new_name;
                }
            } else {
                return response()->json([ [0] ]);
            }
        }
        if ($request->has('subscribe')) {
            $formFields['subscribe'] = 'subscribed';
        } else {
            $formFields['subscribe'] = 'unsubscribed';
        }
        $user->update($formFields);
        return response()->json([ [1] ]);
    }

    // to log user out
    public function logout(){
        auth()->logout();
        return redirect('/signin');
    }
    
}
