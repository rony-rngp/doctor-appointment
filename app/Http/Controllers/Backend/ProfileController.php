<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('backend.auth.profile.view', compact('admin'));
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('backend.auth.profile.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/admin/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(100, 100)->save($image_url);
            
            if(file_exists($admin->image)){
                unlink($admin->image);
            }

            $admin->image = $image_url;
        }
        $admin->save();
        notify()->success('Profile Updated', 'Success');
        return redirect()->back();
    }

    public function show_password()
    {
        return view('backend.auth.profile.edit_password');
    }

    public function check_password(Request $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)){
            echo 'true';
        }else{
            echo  'false';die();
        }
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required',
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)){
            //check new and old password is matching
            if (!Hash::check($request->password_confirmation, Auth::user()->password)) {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->password_confirmation);
                $user->save();

                Auth::logout();
                return redirect()->route('admin');
            }else{
                notify()->error('Sorry ! New password can not be same as old password (:', 'Error');
                return redirect()->back();
            }
        }else{
            notify()->error('Current password is wrong!', 'Error');
            return redirect()->back();
        }
    }
}
