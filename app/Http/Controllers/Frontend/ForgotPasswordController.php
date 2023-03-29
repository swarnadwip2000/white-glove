<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendCodeResetPasswordCustomer;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('frontend.auth.forgot-password');
    }

    public function forgetPasswordCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
        ]);

        $count = User::where('email', $request->email)->role('CUSTOMER')->count();
        if ($count > 0) {
            $user = User::where('email', $request->email)->select('id', 'name', 'email')->first();
            PasswordReset::where('email', $request->email)->delete();
             $id = base64_encode($user->id);
             $token = Str::random(20) . 'pass' . $user->id;

             PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
             ]);

             $details = [
                'id' => $id,
                'token' => $token
             ];
            Mail::to($request->email)->send(new SendCodeResetPasswordCustomer($details));
            
            return redirect()->back()->with('message', "Please! check your mail to reset your password.");
        } else {
            return redirect()->back()->with('error', "Couldn't find your account!");
        }
    }

    public function resetPassword($id, $token)
    {
        $user = User::findOrFail(base64_decode($id));
        $resetPassword = PasswordReset::where('email', $user->email)->first();
        $newTime =  date('h:i A', strtotime( $resetPassword->created_at->addHour()));
        
        if ($newTime > date('h:i A')) {
            return view('frontend.auth.reset-password', compact('user', 'token'));
        } else {
            return redirect()->route('forget.password')->with('error', "Your link has been expired!");
        }
    }

    public function resetPasswordCheck(Request $request)
    {
        
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

       
            if ($request->id != '') {
                // validate token 
                $resetPassword = PasswordReset::where('token', $request->token)->first();
                if ($resetPassword == null) {
                    return redirect()->route('forget.password')->with('error', "Your link has been expired!");
                }
                $id = $request->id;
                User::where('id', $id)->update(['password' => Hash::make($request->password)]);
                $now_time = Carbon::now()->toDateTimeString();    
                return redirect()->route('login')->with('message', 'Password has been changed successfully.');
            } else {
                abort(404);
            }
        

    }
}
