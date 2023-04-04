<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ContactUSController extends Controller
{
    //
    public function addContact(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|min:10',
            'message' => 'required',
        ]);

        $contactUs = new ContactUs();
        $contactUs->name = $request->first_name. ' ' .$request->last_name;
        $contactUs->email = $request->email;
        $contactUs->phone = $request->phone;
        $contactUs->message = $request->message;
        $contactUs->save();

        return redirect()->route('contact')->with('message', 'Message Sent Successfully');

    }
}
