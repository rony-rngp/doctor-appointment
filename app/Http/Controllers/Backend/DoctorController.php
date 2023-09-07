<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    public function show()
    {
        $doctors = Doctor::with('specialist')->latest()->get();
        return view('backend.doctor.view', compact('doctors'));
    }

    public function add()
    {
        $specialists = Specialist::where('status', 1)->latest()->get();
        return view('backend.doctor.add', compact('specialists'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email|unique:doctors',
           'phone' => 'required',
           'gender' => 'required',
           'dob' => 'required',
           'clinic' => 'required',
           'clinic_address' => 'required',
           'fees' => 'required|numeric',
           'specialist_id' => 'required',
           'degree' => 'required',
           'about' => 'required',
            'password' => 'required|min:8|max:32',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $doctor = new Doctor();
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
        $doctor->show_password = $request->password;
        $doctor->status = 1;
        $doctor->password = Hash::make($request->password);

        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/doctor/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(630, 420)->save($image_url);

            $doctor->image = $image_url;
        }
        $doctor->save();

        notify()->success('Doctor Added', 'Success');
        return redirect()->route('admin.doctor.view');
    }

    public function edit($id)
    {
        $doctor = Doctor::with('specialist')->findOrFail($id);
        $specialists = Specialist::where('status', 1)->latest()->get();
        return view('backend.doctor.edit', compact('doctor', 'specialists'));
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

        $doctor = Doctor::with('specialist')->findOrFail($id);;
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

        notify()->success('Doctor Updated', 'Success');
        return redirect()->route('admin.doctor.view');
    }

    public function details(Request $request)
    {
        $doctor = Doctor::with('specialist')->findorFail($request->id);
        return view('backend.doctor.details', compact('doctor'));
    }

    public function status(Request $request)
    {
        $doctor = Doctor::findorFail($request->id);
        $doctor->status = $request->status;
        $doctor->save();
        return response()->json(['messege' => 'success']);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if(file_exists($doctor->image)){
            unlink($doctor->image);
        }
        $doctor->delete();
        notify()->success("Doctor Deleted","Success");
        return redirect()->back();
    }

    public function schedule($id)
    {
        $doctor = Doctor::findOrFail($id);
        $schedules = Schedule::with('day')->where('doctor_id', $doctor->id)->where('status', 1)->get()->groupBy('day_id');
        return view('backend.doctor.schedule', compact('doctor', 'schedules'));
    }
}
