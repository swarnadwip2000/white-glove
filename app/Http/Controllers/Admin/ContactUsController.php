<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    //
    public function contactUs()
    {
        $contactUs = ContactUs::Orderby('id', 'desc')->get();
        return view('admin.contact-us.list',compact('contactUs'));
    }
}
