<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutCms;
use App\Models\ContactUsCms;
use App\Models\HomeCms;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CmsController extends Controller
{
    use ImageTrait;

    public function homeCms()
    {
        $home = HomeCms::first();
        return view('admin.cms.home-cms')->with(compact('home'));
    }

    public function homeCmsStore(Request $request)
    {
       $validateData =  $request->validate([
            'banner_title'=>'required',
            'banner_description' => 'required',
            'section_2_title' => 'required',
            'section_3_title' => 'required',
            'section_3_description' => 'required',
        ]);

        $homeCms =  HomeCms::findOrFail($request->id);
        if ($request->hasFile('section_2_image')) {
            $request->validate([
                'section_2_image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ]);

            $fileData = $this->imageUpload($request->file('section_2_image'), 'home');
            if (!empty($fileData['filePath'])) {
                
                $homeCms->section_2_image = $fileData['filePath'] ?? null;
            }
        }

        if ($request->hasfile('section_3_image')) {
            $request->validate([
                'section_3_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $fileData = $this->imageUpload($request->file('section_3_image'), 'home');
            if (!empty($fileData['filePath'])) {
                
                $homeCms->section_3_image = $fileData['filePath'] ?? null;
            }
        }
        $homeCms->banner_title = $request->banner_title;
        $homeCms->banner_description = $request->banner_description;
        $homeCms->section_2_title = $request->section_2_title;
        $homeCms->section_3_title = $request->section_3_title;
        $homeCms->section_3_description = $request->section_3_description;
        $homeCms->save();
        return redirect()->back()->with('message', 'Home page content has been updated successfully.');
        
    }

    public function aboutCms()
    {
        $about = AboutCms::first();
        return view('admin.cms.about-cms')->with(compact('about'));
    }

    public function aboutCmsStore(Request $request)
    {
       
        $validateData =  $request->validate([
            'banner_name' => 'required',
            'section_1_name' => 'required',
            'section_1_title' => 'required',
            'section_1_description' => 'required',
            'section_2_title' => 'required',
            'section_3_title' => 'required',
            'section_3_description' => 'required',
            
        ]);

        $aboutCms =  AboutCms::findOrFail($request->id);
        if ($request->hasFile('section_1_img')) {
            $request->validate([
                'section_1_img' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ]);

            $fileData = $this->imageUpload($request->file('section_1_img'), 'about');
            if (!empty($fileData['filePath'])) {
                
                $aboutCms->section_1_img = $fileData['filePath'] ?? null;
            }
        }

        if ($request->hasfile('section_2_banner')) {
            $request->validate([
                'section_2_banner' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $fileData = $this->imageUpload($request->file('section_2_banner'), 'home');
            if (!empty($fileData['filePath'])) {
                
                $aboutCms->section_2_banner = $fileData['filePath'] ?? null;
            }
        }

        if ($request->hasfile('section_3_img')) {
            $request->validate([
                'section_3_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $fileData = $this->imageUpload($request->file('section_3_img'), 'home');
            if (!empty($fileData['filePath'])) {
                
                $aboutCms->section_3_img = $fileData['filePath'] ?? null;
            }
        }
        
        $aboutCms->banner_name = $request->banner_name;
        $aboutCms->section_1_name = $request->section_1_name;
        $aboutCms->section_1_title = $request->section_1_title;
        $aboutCms->section_1_description = $request->section_1_description;
        $aboutCms->section_2_title = $request->section_2_title;
        $aboutCms->section_3_title = $request->section_3_title;
        $aboutCms->section_3_description = $request->section_3_description;
        $aboutCms->save();

        return redirect()->back()->with('message', 'About us page content has been updated successfully.');
    }

   
    public function contactUsCms()
    {
        $contactUs = ContactUsCms::first();
        return view('admin.cms.contact-us-cms')->with(compact('contactUs'));
    }

    public function contactUsCmsStore(Request $request)
    {
        $validateData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'visit_us' => 'required',
            'call_us' => 'required|min:10|max:16',
            'mail_us' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ]);

        $contactUsCms =  ContactUsCms::findOrFail($request->id);
        $contactUsCms->title = $request->title;
        $contactUsCms->description = $request->description;
        $contactUsCms->visit_us = $request->visit_us;
        $contactUsCms->call_us = $request->call_us;
        $contactUsCms->mail_us = $request->mail_us;
        $contactUsCms->save();

        return redirect()->back()->with('message', 'Contact us page content has been updated successfully.');
    }
}
