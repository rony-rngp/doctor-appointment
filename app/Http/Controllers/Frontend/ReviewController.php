<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show()
    {
        $patient = Auth::guard('patient')->user();
        $reviews = Review::with('appointment')->where('patient_id', Auth::guard('patient')->user()->id)->get();
        return view('frontend.account.review_list',compact('reviews', 'patient'));
    }

    public function add($id)
    {
        $patient = Auth::guard('patient')->user();
        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        if ($appointment->patient_id == Auth::guard('patient')->id()){
            if ($appointment->status == 'Pending'){
                notify()->error('Yor appointment not completed', 'Error');
                return redirect()->back();
            }else{
                return view('frontend.account.review', compact('appointment', 'patient'));
            }

        }else{
            abort(401);
        }
    }

    public function store(Request $request, $id)
    {

        $this->validate($request, [
           'ratting' => 'required|numeric',
            'title' => 'required',
            'review' => 'required'
        ]);

        $appointment = Appointment::with('doctor', 'day')->findOrFail($id);
        if ($appointment->patient_id == Auth::guard('patient')->id()){

            $review_count = Review::where('appointment_id',$appointment->id)->count();
            if ($review_count == 0){
                $review = new Review();
                $review->appointment_id	= $appointment->id;
                $review->patient_id	 = Auth::guard('patient')->id();
                $review->doctor_id = $appointment->doctor_id;
                $review->ratting = $request->ratting;
                $review->title = $request->title;
                $review->review = $request->review;
                $review->status = 0;
                $review->save();
                notify()->success('Review Added', 'Success');
                return redirect()->route('patient.view.review');
            }else{
                notify()->error('Your review already added for this appointment.');
                return redirect()->back();
            }

        }else{
            abort(401);
        }
    }
}
