<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show()
    {
        $reviews = Review::with('appointment')->latest('id')->get();
        return view('backend.review.view', compact('reviews'));
    }

    public function details(Request $request)
    {

        $review = Review::with('patient')->where('id', $request->id)->first();
        return view('backend.review.details', compact('review'));
    }

    public function status(Request $request)
    {
        $review = Review::find($request->id);
        $review->status = $request->status;
        $review->save();
        return response()->json(['action' => 'success']);
    }
}
