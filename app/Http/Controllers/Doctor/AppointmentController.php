<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function show()
    {
        $appointments = Appointment::with('patient', 'main_schedule')->where('doctor_id', Auth::guard('doctor')->id())->latest()->get();
        return view('doctor.appointment.view', compact('appointments'));
    }

    public function details($id)
    {
        $appointment = Appointment::with('patient', 'main_schedule')->where(['id'=> $id])->firstOrFail();
        if($appointment->doctor_id == Auth::guard('doctor')->id()){
            return view('doctor.appointment.details', compact('appointment'));
        }else{
            abort(401);
        }
    }

    public function check_opt(Request $request)
    {
        $appointment_id = $request->appointment_id;
        $status = $request->status;

        $appointment = Appointment::where(['id'=> $appointment_id])->firstOrFail();

        if ($status == 'Confirmed'){
            if ($status == 'Confirmed' && $appointment->status == 'Confirmed'){
                return response()->json([
                    'status' => false,
                    'message' => 'Sorry! status already Updated',
                ]);
            }else{
                if($appointment->doctor_id == Auth::guard('doctor')->id()){

                    $otp = rand(000000, 999999);
                    $appointment->otp = $otp;
                    $appointment->save();

                    //-------bulksms api----

//                    $url = "http://66.45.237.70/api.php";
//                    $number= $appointment->patient_phone;
//                    $text="Your otp code is ". $otp;
//                    $data= array(
//                        'username'=>"01792702312",
//                        'password'=>"8PDS4FC7",
//                        'number'=>"$number",
//                        'message'=>"$text"
//                    );
//                    $ch = curl_init(); // Initialize cURL
//                    curl_setopt($ch, CURLOPT_URL,$url);
//                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                    $smsresult = curl_exec($ch);
//                    $p = explode("|",$smsresult);
//                    $sendstatus = $p[0];


                    return response()->json([
                        'status' => true,
                        'message' => 'Otp Send Successfully',
                    ]);

                }else{
                    return response()->json([
                        'status' => false,
                        'message' => '401 | UNAUTHORIZED',
                    ]);
                }
            }
        }

    }

    public function update(Request $request, $id)
    {
        if ($request->status == 'Pending' || $request->status == 'Confirmed'){

            $appointment = Appointment::where(['id'=> $id])->firstOrFail();

            if ($request->status == 'Pending' && $appointment->status == 'Pending'){
                notify()->error("Sorry! You can't update same status", "Error");
                return redirect()->back();
            }

            if ($request->status == 'Confirmed'){

                if ($request->status == 'Confirmed' && $appointment->status == 'Confirmed'){
                    notify()->error('Sorry! status already Updated', 'Error');
                    return redirect()->back();
                }else{
                    if ($request->otp != null){
                        if($appointment->doctor_id == Auth::guard('doctor')->id()){

                            if($request->otp == $appointment->otp){
                                $appointment->status = $request->status;
                                $doctor = Auth::guard('doctor')->user();
                                $doctor->amount = $doctor->amount + $appointment->fees;
                                $doctor->total_amount = $doctor->total_amount + $appointment->fees;
                                $doctor->save();
                                $appointment->save();
                                notify()->success("Status Updated", 'Success');
                                return redirect()->back();
                            }else{
                                notify()->error('Invalid Otp Code', 'Error');
                                return redirect()->back();
                            }

                        }else{
                            abort(401);
                        }
                    }else{
                        notify()->error('Sorry! Otp filed is required!', 'Error');
                        return redirect()->back();
                    }
                }


            }else{
                notify()->error('Sorry! status already confirmed', 'Error');
                return redirect()->back();
            }


        }else{
            notify()->error("Don't try to over smart", 'Error');
            return redirect()->back();
        }
    }
}
