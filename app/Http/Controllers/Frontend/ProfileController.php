<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $patient = Auth::guard('patient')->user();
        return view('frontend.account.profile.view', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        if ($patient->id == Auth::guard('patient')->id()){
            return view('frontend.account.profile.edit', compact('patient'));
        }else{
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'blood_group' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $patient = Patient::findOrFail($id);
        if ($patient->id == Auth::guard('patient')->id()){
            $patient->name = $request->name;
            $patient->phone = $request->phone;
            $patient->gender = $request->gender;
            $patient->dob = $request->dob;
            $patient->address = $request->address;
            $patient->blood_group = $request->blood_group;

            $image = $request->file('image');
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/patient/';
                $image_url = $upload_path . $image_fill_name;
                Image::make($image)->resize(300, 300)->save($image_url);

                if(file_exists($patient->image)){
                    unlink($patient->image);
                }

                $patient->image = $image_url;
            }
            $patient->save();

            notify()->success('Profile Updated', 'Success');
            return redirect()->route('patient.view.profile');

        }else{
            abort(401);
        }

    }

    public function show_password()
    {
        $patient = Auth::guard('patient')->user();
        return view('frontend.account.profile.edit_password', compact('patient'));
    }

    public function check_password(Request $request)
    {
        if (Hash::check($request->current_password, Auth::guard('patient')->user()->password)){
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

        if (Hash::check($request->current_password, Auth::guard('patient')->user()->password)){
            //check new and old password is matching
            if (!Hash::check($request->password_confirmation, Auth::guard('patient')->user()->password)) {
                $user = Patient::find(Auth::guard('patient')->user()->id);
                $user->password = Hash::make($request->password_confirmation);
                $user->save();

                Auth::guard('patient')->logout();
                return redirect()->route('login');
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
