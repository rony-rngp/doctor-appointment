<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function show()
    {
        $appointments = Appointment::with('doctor', 'day')->latest()->get();
        return view('backend.appointment.view', compact( 'appointments'));
    }

    public function details($id)
    {
        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        return view('backend.appointment.details', compact('appointment'));
    }

    public function print_appointment($id){
        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        return view('backend.appointment.print_appointment', compact('appointment'));
    }
}
