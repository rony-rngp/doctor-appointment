<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Cms;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialist;
use App\Models\SSLCommerz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        $specialists = Specialist::where('status', 1)->get();
        $doctors = Doctor::with('specialist', 'schedule', 'reviews')->where('status', 1)->get();
        return view('frontend.home', compact('specialists', 'doctors'));
    }

    public function doctors()
    {
        $doctors = Doctor::with('specialist', 'schedule', 'reviews')->where('status', 1)->get();
        $specialists = Specialist::where('status', 1)->get();
        return view('frontend.doctors', compact('doctors', 'specialists'));
    }

    public function search_doctors(Request $request)
    {
        $query = $request->search;
        $q_specialist = $request->select_specialist;
        if($q_specialist == null){
            $doctors = Doctor::where('name', 'LIKE', "%{$request->search}%")->where('status', 1)->get();
        }else{
            $doctors = Doctor::where('specialist_id', $request->select_specialist)->where('name', 'LIKE', "%{$request->search}%")->where('status', 1)->get();
        }
        $specialists = Specialist::where('status', 1)->get();
        return view('frontend.doctors', compact('doctors', 'specialists', 'query', 'q_specialist'));
    }

    public function cms($slug)
    {
        $cms = Cms::where('slug', $slug)->where('status', 1)->firstOrFail();
        $meta_description = $cms->meta_description;
        $meta_keyword = $cms->meta_keyword;
        return view('frontend.cms_page', compact('cms', 'meta_description', 'meta_keyword'));
    }

    public function doctor_profile($id)
    {
        $doctor = Doctor::with('specialist', 'schedule', 'reviews')->where(['id' => $id, 'status' => 1])->firstOrFail();
        $schedules = Schedule::with('day')->where('doctor_id', $doctor->id)->where('status', 1)->get()->groupBy('day_id');
        return view('frontend.doctor_profile', compact('doctor', 'schedules'));
    }

    public function doctor_booking($id)
    {
        $doctor = Doctor::with('specialist', 'schedule', 'reviews')->where(['id' => $id, 'status' => 1])->firstOrFail();
        $schedules = Schedule::with('day')->where('doctor_id', $doctor->id)->where('status', 1)->get()->groupBy('day_id');
        $patient = Auth::guard('patient')->user();
        return view('frontend.doctor_booking', compact('doctor', 'schedules', 'patient'));
    }

    public function check_schedule(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $date = $request->date;

        $day = date('l', strtotime($date));
        $get_main_day = Day::where('name', $day)->first()->id;
        $schedules = Schedule::where(['doctor_id' => $doctor_id, 'day_id' => $get_main_day])->where('status', 1)->get();

        if ($schedules->count() != 0) {
            return response()->json([
                'schedules' => $schedules,
                'status' => true,
                'message' => '',
            ]);
        } else {
            return response()->json([
                'schedules' => $schedules,
                'status' => false,
                'message' => 'Schedule not found on ' . $day,
            ]);
        }
    }

    public function check_available_schedule(Request $request)
    {
        $check_schedule = Schedule::where(['id' => $request->schedule_id, 'doctor_id' => $request->doctor_id, 'status' => 1])->first();

        $date = $request->date;


        if ($check_schedule != null){

                $check_appointment_count = Appointment::where(['doctor_id' => $check_schedule->doctor_id, 'day_id' => $check_schedule->day_id, 'schedule_id' => $check_schedule->id, 'appointment_date'=>$date])->count();

                if($check_schedule->maximum_patient > $check_appointment_count){
                    return response()->json([
                        'status' => true,
                        'message' => 'Available'
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Maximum Quota (' . $check_schedule->maximum_patient . ') is Filled'
                    ]);
                }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found'
            ]);
        }

    }

    public function book(Request $request)
    {
        $this->validate($request, [
           'doctor_id' => 'required',
           'date' => 'required',
           'schedule_id' => 'required',
           'patient_name' => 'required',
           'patient_phone' => 'required',
           'patient_gender' => 'required',
           'patient_dob' => 'required',
           'patient_blood_group' => 'required',
           'payment_method' => 'required',
        ]);

        $doctor_id = $request->doctor_id;
        $date = date('Y-m-d', strtotime($request->date));

        $day = date('l', strtotime($date));

        $get_main_day = Day::where('name', $day)->first()->id;
        $schedules = Schedule::where(['doctor_id' => $doctor_id, 'day_id' => $get_main_day])->where('status', 1)->get();
        if ($schedules->count() == 0) {
            notify()->error('Schedule not found on ' . $day, 'Error');
            return redirect()->back();
        }

        $check_schedule = Schedule::where(['id' => $request->schedule_id, 'doctor_id' => $request->doctor_id, 'status' => 1])->first();

        if ($check_schedule == null){
            notify()->error('Data not found', 'Error');
            return redirect()->back();
        }


        $check_appointment_count = Appointment::where(['doctor_id' => $check_schedule->doctor_id, 'day_id' => $check_schedule->day_id, 'schedule_id' => $check_schedule->id, 'appointment_date'=>$date])->count();
        if($check_schedule->maximum_patient > $check_appointment_count){


            $doctor = Doctor::find($doctor_id);

            $appointment = new Appointment();
            $appointment->patient_id = Auth::guard('patient')->user()->id;
            $appointment->doctor_id = $check_schedule->doctor_id;
            $appointment->schedule_id  = $check_schedule->id;
            $appointment->day_id = $check_schedule->day_id;
            $appointment->appointment_date = $date;
            $appointment->fees = $doctor->fees;
            $appointment->clinic_name = $check_schedule->clinic_name;
            $appointment->clinic_address = $check_schedule->clinic_address;
            $appointment->schedule = $check_schedule->start_time.' - '.$check_schedule->end_time;
            $appointment->patient_name = $request->patient_name;
            $appointment->patient_phone = $request->patient_phone;
            $appointment->patient_gender = $request->patient_gender;
            $appointment->patient_dob = $request->patient_dob;
            $appointment->patient_blood_group = $request->patient_blood_group;
            $appointment->payment_method = $request->payment_method;



            if ($request->payment_method == 'Paypal'){
                //----forget old session
                Session::forget('appointment');
                //----add new session---
                Session::put('appointment', $appointment);
                return redirect()->route('charge');
            }

            if ($request->payment_method == 'Sslcommerz'){
                SSLCommerz::getPayment($appointment);
            }


            if ($request->payment_method == 'Bkash'){
                //----forget old session
                Session::forget('appointment');
                Session::forget('amount');


                Session::put('appointment', $appointment);
                Session::put('amount', $appointment->fees);

                if (Session::has('appointment')){
                    return View::make('frontend.bkash_payment');
                }else{
                    notify()->error('Something went to wrong', 'error');
                    return redirect()->back();
                }

            }




        }else{
            notify()->error('Maximum Quota (' . $check_schedule->maximum_patient . ') is Filled', 'Error');
            return redirect()->back();
        }



    }

}
