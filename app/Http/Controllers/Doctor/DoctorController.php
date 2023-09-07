<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function doctor_login(Request $request)
    {
        if (Auth::guard('doctor')->check()){
            return redirect('/doctor/dashboard');
        }

        if ($request->isMethod('post')){
            $this->validate($request, [
               'email' => 'required',
               'password' => 'required',
            ]);

            if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' =>$request->password])){
                return redirect()->route('doctor.dashboard');
            }else{
                return redirect()->back();
            }
        }
        return view('doctor.auth.login');
    }

    public function dashboard()
    {
        $doctor = Auth::guard('doctor')->user();
        $data['total_appointment_count'] = Appointment::where('doctor_id', Auth::guard('doctor')->id())->where('status', 'Confirmed')->count();
        $data['pending_appointment_count'] = Appointment::where('doctor_id', Auth::guard('doctor')->id())->where('status', 'Pending')->count();
        $data['total_withdraw'] = Withdraw::where('doctor_id', $doctor->id)->where('status', 1)->sum('amount');
        $data['pending_withdraw'] = Withdraw::where('doctor_id', $doctor->id)->where('status', 0)->sum('amount');

        $months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');


        foreach ($months as $month){

            $apppontments = Appointment::where('doctor_id', Auth::guard('doctor')->id())->where('status', 'Confirmed')->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->get();

            $d = date('d', strtotime(Carbon::today()));
            $y = date('Y', strtotime(Carbon::today()));

            $chart[] = array(
                'label' => date('M', strtotime($y.'-'.$month.'-'.$d)),
                'y' => $apppontments->count()
            );
        }

        return view('doctor.dashboard',compact('doctor', 'chart'), $data);
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
