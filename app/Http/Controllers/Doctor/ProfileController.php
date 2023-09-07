<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $doctor = Auth::guard('doctor')->user();
        return view('doctor.profile.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::with('specialist')->findOrFail($id);
        $specialists = Specialist::where('status', 1)->latest()->get();
        return view('doctor.profile.edit', compact('doctor', 'specialists'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:doctors,email,'.$id,
            'phone' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'clinic' => 'required',
            'clinic_address' => 'required',
            'fees' => 'required|numeric',
            'specialist_id' => 'required',
            'degree' => 'required',
            'about' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $doctor = Doctor::findOrFail($id);;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->gender = $request->gender;
        $doctor->dob = date('Y-m-d', strtotime($request->dob));
        $doctor->clinic = $request->clinic;
        $doctor->clinic_address = $request->clinic_address;
        $doctor->fees = $request->fees;
        $doctor->specialist_id = $request->specialist_id;
        $doctor->degree = $request->degree;
        $doctor->about = $request->about;

        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/doctor/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(630, 420)->save($image_url);

            if(file_exists($doctor->image)){
                unlink($doctor->image);
            }

            $doctor->image = $image_url;
        }
        $doctor->save();

        notify()->success('Profile Updated', 'Success');
        return redirect()->route('doctor.view.profile');
    }

    public function show_password()
    {
        return view('doctor.profile.edit_password');
    }

    public function check_password(Request $request)
    {
        if (Hash::check($request->current_password, Auth::guard('doctor')->user()->password)){
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

        if (Hash::check($request->current_password, Auth::guard('doctor')->user()->password)){
            //check new and old password is matching
            if (!Hash::check($request->password_confirmation, Auth::guard('doctor')->user()->password)) {
                $user = Doctor::find(Auth::guard('doctor')->user()->id);
                $user->password = Hash::make($request->password_confirmation);
                $user->show_password = $request->password_confirmation;
                $user->save();

                Auth::guard('doctor')->logout();
                return redirect()->route('doctor.login');
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
