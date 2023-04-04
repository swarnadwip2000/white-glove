<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ImageTrait;
    public function index()
    {
        return view('admin.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,'.Auth::user()->id,
        ]);

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpg,webp,png,jpeg,gif,svg|max:2048',
            ]);
            $fileData = $this->imageUpload($request->file('profile_picture'), 'admin');
            if (!empty($fileData['filePath'])) {
                if ((!empty($data->profile_picture)) && Storage::exists($data->profile_picture)) {
                    Storage::delete($data->profile_picture);
                }
                $data->profile_picture = $fileData['filePath'] ?? null;
            }
        }
        $data->save();
        return redirect()->back()->with('message', 'Profile updated successfully.');
    }

    public function password()
    {
        return view('admin.password');
    }

    public function passwordUpdate(Request $request)
    {
        
        $request->validate([
            'old_password' => 'required|min:8|password',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|min:8|same:new_password', 
        
        ],[
            'old_password.password'=> 'Old password is not correct',
        ]);

        $data = User::find(Auth::user()->id);
        $data->password = Hash::make($request->new_password);
        $data->update();
        return redirect()->back()->with('message', 'Password updated successfully.');
    }
}
