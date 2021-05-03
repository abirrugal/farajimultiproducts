<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerificationEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

//Go to registration page

    public function registerPage(){
        return view('frontend.auth.register');
    }

//Registration Logic

    public function registerLogic(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|min:11|numeric|unique:users,phone_number',
            'password' => 'required|min:4|confirmed'

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->withInput();
        }

     $user =   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => trim($request->phone),
            'password' => Hash::make($request->password),
            'email_verification_token' => uniqid(time().$request->email).Str::random(15),
        ]);

// Auth::attempt($request->only('email','password'));
            $this->successMessage('Registration successfull. Please verify your email');

//Send Verification Email to new created user mail

       $user->notify(new VerificationEmailNotification($user));

            return redirect()->route('login');

    }

//Go to Login page

    public function loginPage(){
        return view('frontend.auth.login');
    }

//Login Logic

    public function loginLogic(Request $request){

        $validator = Validator::make($request->all(), [
        
            'email' => 'required|email|max:255',    
            'password' => 'required|min:4'

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->withInput();
        }

    //If user didn't verified email successfully then email_verified_at will null
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){

        if(auth()->user()->email_verified_at === null){
            $this->errorMessage('Your email is not verified. Please verify your email first');
            Auth::logout();
            return redirect()->route('login');
        }

    //If user verified email then we will send him back to the page where he come from,

        $this->successMessage('Logged in success');
        if (auth()->user()->role_as === 'admin') {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('frontend.product.index');
        }
       
    }
     
    }

//Logout user

public function logout(){
 Auth::logout();
 $this->successMessage('Logout success');
 return redirect()->back();
}

//Activate Email 
    public function activate($token = null){
      
//If user not provide any token

        if($token === null){
            $this->errorMessage('Your token is empty.Please Click to correct verification link.');
            return redirect()->route('login');
        }

//Find User which provided token match 
        $user = User::where('email_verification_token', $token)->firstOrFail();

//If match the token
        if($user){
//If match the token we will set email_verification_token null 
// and email_verified_at with current time.
            $user->update([
                'email_verification_token' => null,
                'email_verified_at' => Carbon::now(),
            ]);
            
            $this->successMessage('Email verified success. Please login now');

            return redirect()->route('login');
        }

//If do not match the token
        $this->errorMessage('Your verification link is invalid.');
    }


}
