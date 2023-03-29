<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = true;
        $user->save();
        $user->assignRole('CUSTOMER');
        $maildata = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        Mail::to($request->email)->send(new WelcomeMail($maildata));
        return redirect()->route('login')->with('message', 'Registration Successfully');
    }

    public function loginCheck(Request $request)
    {
    
        $request->validate([
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status == true) {
                if ($user->hasRole('CUSTOMER')) {
                    // update cart table with user id
                    Cart::where('session_id', Session::get('session_id'))->update(['user_id' => $user->id]);
                   
                    return redirect()->route('home')->with('message', 'Login Successfully.');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'You are not a customer!!');
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is not active!!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials!!');    
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('message', 'Logout Successfully');
    }
}
