<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        if (Auth::check()){
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post')){
            $this->validate($request, [
               'email' => 'required|email',
                'password' => 'required'
            ]);

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->back();
            }

        }

        return view('backend.auth.login');
    }

    public function dashboard()
    {
        $data['doctor_count'] = Doctor::count();
        $data['patient_count'] = Patient::count();
        $data['appointment_count'] = Appointment::count();
        $data['pending_appoint_count'] = Appointment::where('status', 'Pending')->count();
        $data['complete_appoint_count'] = Appointment::where('status', 'Confirmed')->count();
        $data['total_appointment_amount'] = Doctor::select('total_amount')->sum('total_amount');
        $data['total_withdraw_amount'] = Withdraw::sum('amount');
        $data['total_current_amount'] = Doctor::sum('amount');
        $doctors = Doctor::with('appointments')->latest()->get();
        foreach ($doctors as $doctor){
            $graph[] = array(
                'label' => $doctor->name,
                'y' => $doctor->appointments->count()
            );
        }

        $months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');


        foreach ($months as $month){

            $apppontments = Appointment::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->get();

            $d = date('d', strtotime(Carbon::today()));
            $y = date('Y', strtotime(Carbon::today()));

            $chart[] = array(
                'label' => date('M', strtotime($y.'-'.$month.'-'.$d)),
                'y' => $apppontments->count()
            );
        }



        return view('backend.dashboard',compact('graph', 'chart'), $data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
