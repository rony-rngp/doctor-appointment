<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function show()
    {
        $patients = Patient::latest()->get();
        return view('backend.patient.show', compact('patients'));
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        notify()->success('Patient Deleted', 'Success');
        return redirect()->back();
    }

    public function details(Request $request)
    {
        $patient = Patient::findorFail($request->id);
        return view('backend.patient.details', compact('patient'));
    }

    public function status(Request $request)
    {
        $patient = Patient::findorFail($request->id);
        $patient->status = $request->status;
        $patient->save();
        return response()->json(['messege' => 'success']);
    }
}
