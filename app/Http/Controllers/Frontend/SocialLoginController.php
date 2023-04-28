<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SocialLoginController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        
        try {
            
            $user = Socialite::driver($provider)->stateless()->user();
            // dd($user);
            $finduser = User::where('email', $user->email)->first();

            if($finduser){
                
                Auth::login($finduser);
       
                return redirect()->route('home')->with('message', 'Login Successfully');

            }else{
                if($user->avatar != null)
                {
                    $fileContents = file_get_contents($user->avatar);
                    $filename = 'en'. $user->id . date('YmdHi').'.jpg';
                    Storage::put('public/customer/'.$filename, $fileContents);
                    $file_name = 'customer/'.$filename;
                }else{
                    $file_name = NULL;
                }
                
               
                    $newUser = new User();
                    $newUser->name = $user->name;
                    $newUser->email = $user->email;
                    
                    if($provider == 'google')
                    {
                        $newUser->social_id = $user->id;
                        $newUser->social_type =  'google';
                    }else {
                        $newUser->social_id =  $user->id;
                        $newUser->social_type = 'facebook';
                    }
                    $newUser->password = Hash::make($user->name.'@'.$user->id);
                    $newUser->profile_picture = $file_name;
                    $newUser->status = true;
                    $newUser->save();
                    $newUser->assignRole('CUSTOMER');
                    // dd($newUser);
                    Auth::login($newUser);
                   
                    $maildata = [
                        'name' => $user->name,
                        'email' => $user->email,
                    ];
                    Mail::to($user->email)->send(new WelcomeMail($maildata));

                    return redirect()->route('home')->with('message', 'Login Successfully');
            }

        } catch (\Throwable $th) {
            //throw $th;
           return redirect()->route('home')->with('message', $th->getMessage());
        } 
    }
}
