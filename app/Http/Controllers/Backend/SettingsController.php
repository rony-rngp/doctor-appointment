<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = Settings::findOrFail(1);
        return view('backend.settings.view', compact('settings'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
           'website_name' => 'required',
           'website_email' => 'required',
           'website_phone' => 'required',
           'website_address' => 'required',
           'meta_description' => 'required',
           'meta_keyword' => 'required',
           'facebook' => 'required',
           'twitter' => 'required',
           'linkedin' => 'required',
           'instagram' => 'required',
            'favicon' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'header_logo' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'footer_logo' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $settings = Settings::findOrFail(1);
        $settings->website_name = $request->website_name;
        $settings->website_email = $request->website_email;
        $settings->website_phone = $request->website_phone;
        $settings->website_address = $request->website_address;
        $settings->meta_description = $request->meta_description;
        $settings->meta_keyword = $request->meta_keyword;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->linkedin = $request->linkedin;
        $settings->instagram = $request->instagram;

        $favicon = $request->file('favicon');
        if($favicon){
            $image_name = hexdec(uniqid());
            $ext = strtolower($favicon->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/favicon/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($favicon)->resize(32, 32)->save($image_url);
            if(file_exists($settings->favicon)){
                unlink($settings->favicon);
            }
            $settings->favicon = $image_url;
        }

        $header_logo = $request->file('header_logo');
        if($header_logo){
            $image_name = hexdec(uniqid());
            $ext = strtolower($header_logo->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/header_logo/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($header_logo)->resize(201, 52)->save($image_url);
            if(file_exists($settings->header_logo)){
                unlink($settings->header_logo);
            }
            $settings->header_logo = $image_url;
        }

        $footer_logo = $request->file('footer_logo');
        if($footer_logo){
            $image_name = hexdec(uniqid());
            $ext = strtolower($footer_logo->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/footer_logo/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($footer_logo)->resize(201, 52)->save($image_url);
            if(file_exists($settings->footer_logo)){
                unlink($settings->footer_logo);
            }
            $settings->footer_logo = $image_url;
        }

        $settings->save();
        notify()->success('Settings Updated', 'Success');
        return redirect()->back();
    }
}
