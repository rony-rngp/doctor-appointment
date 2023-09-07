<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function show()
    {
        $schedules = Schedule::with('day')->where('doctor_id', Auth::guard('doctor')->user()->id)->get();
        return view('doctor.schedule.view', compact('schedules'));
    }

    public function add()
    {
        $days = Day::all();
        return view('doctor.schedule.add', compact('days'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'day_id' => 'required',
           'clinic_name' => 'required',
           'clinic_address' => 'required',
           'maximum_patient' => 'required|numeric',
           'start_time' => 'required',
           'end_time' => 'required',
        ]);

        $schedule = new Schedule();
        $schedule->doctor_id = Auth::guard('doctor')->user()->id;
        $schedule->day_id = $request->day_id;
        $schedule->clinic_name = $request->clinic_name;
        $schedule->clinic_address = $request->clinic_address;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->maximum_patient = $request->maximum_patient;
        $schedule->status = 1;
        $schedule->save();

        notify()->success('Schedule Added', 'Success');
        return redirect()->route('doctor.schedule.view');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        if ($schedule->doctor_id == Auth::guard('doctor')->user()->id){
            $days = Day::all();
            return view('doctor.schedule.edit', compact('days', 'schedule'));
        }else{
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'day_id' => 'required',
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'maximum_patient' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = Schedule::findOrFail($id);

        if($schedule->doctor_id == Auth::guard('doctor')->user()->id){

            $schedule->day_id = $request->day_id;
            $schedule->clinic_name = $request->clinic_name;
            $schedule->clinic_address = $request->clinic_address;
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
            $schedule->maximum_patient = $request->maximum_patient;
            $schedule->save();

            notify()->success('Schedule Updated', 'Success');
            return redirect()->route('doctor.schedule.view');

        }else{
            abort(401);
        }
    }

    public function details(Request $request)
    {
        $schedule = Schedule::with('doctor', 'day')->findorFail($request->id);
        if($schedule->doctor_id == Auth::guard('doctor')->user()->id){

            return view('doctor.schedule.details', compact('schedule'));

        }else{
            abort(401);
        }

    }

    public function destroy($id)
    {
        $schedule = Schedule::findorFail($id);
        if($schedule->doctor_id == Auth::guard('doctor')->user()->id){
            $schedule->delete();
            notify()->success('Schedule Deleted', 'Success');
            return redirect()->back();
        }else{
            abort(401);
        }
    }

    public function status(Request $request)
    {
        $schedule = Schedule::findorFail($request->id);
        if($schedule->doctor_id == Auth::guard('doctor')->user()->id){
            $schedule->status = $request->status;
            $schedule->save();
            return response()->json(['messege' => 'success']);
        }else{
            abort(401);
        }

    }
}
