<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PatientController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('patient')->check()){
            return redirect('/patient/dashboard');
        }

        if($request->isMethod('post')){
            $this->validate($request, [
               'email' => 'required|email',
               'password' => 'required'
            ]);

            if(Auth::guard('patient')->attempt(['email'=> $request->email, 'password' => $request->password])){
                $user_status = Patient::where('email', $request->email)->first();
                if($user_status->status == 0){
                    Auth::guard('patient')->logout();
                    notify()->error('Your account is not activated yet! you need to contact admin !', 'Error');
                    return redirect()->back();
                }

                return redirect()->route('patient.dashboard');

            }else{
                notify()->error('These credentials do not match our records','Error');
            }

        }

        return view('frontend.auth.login');
    }

    public function register(Request $request)
    {
        if (Auth::guard('patient')->check()){
            return redirect('/patient/dashboard');
        }

        if ($request->isMethod('post')){

            $this->validate($request, [
               'name' => 'required',
               'email' => 'required|email|unique:patients',
               'phone' => 'required',
               'gender' => 'required',
               'dob' => 'required',
               'address' => 'required',
               'blood_group' => 'required',
               'password' => ['required', 'string', 'min:8', 'confirmed'],
               'password_confirmation' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:3048',
            ]);

            $patient = new Patient();
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->gender = $request->gender;
            $patient->dob = $request->dob;
            $patient->address = $request->address;
            $patient->blood_group = $request->blood_group;
            $patient->password = Hash::make($request->password_confirmation);
            $patient->status = 1;

            $image = $request->file('image');
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/patient/';
                $image_url = $upload_path . $image_fill_name;
                Image::make($image)->resize(300, 300)->save($image_url);

                $patient->image = $image_url;
            }

            $patient->save();

            notify()->success('Registration Successful');
            return redirect()->route('login');

        }

        return view('frontend.auth.register');

    }

    public function dashboard()
    {
        $patient = Auth::guard('patient')->user();
        $appointments = Appointment::with('doctor', 'day')->where('patient_id', $patient->id)->latest()->get();
        return view('frontend.account.user_account', compact('patient', 'appointments'));
    }

    public function appointment_details($id)
    {
        $patient = Auth::guard('patient')->user();
        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        if ($appointment->patient_id == Auth::guard('patient')->id()){
            return view('frontend.account.appointment_details', compact('appointment', 'patient'));
        }else{
            abort(401);
        }
    }

    public function print_appointment($id){
        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        if ($appointment->patient_id == Auth::guard('patient')->id()){
            return view('frontend.account.print_appointment', compact('appointment'));
        }else{
            abort(401);
        }
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        Session::forget('appointment');
        return redirect()->route('login');
    }
}
