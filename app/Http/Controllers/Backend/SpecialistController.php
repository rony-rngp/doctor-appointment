<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SpecialistController extends Controller
{
    public function show()
    {
        $specialists = Specialist::latest()->get();
        return view('backend.specialist.view', compact('specialists'));
    }

    public function add()
    {
        return view('backend.specialist.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:specialists',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $specialist = new Specialist();
        $specialist->name = $request->name;
        $specialist->status = 1;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/specialist/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(64, 64)->save($image_url);

            $specialist->image = $image_url;
        }

        $specialist->save();

        notify()->success('Specialist Added', 'Success');
        return redirect()->route('admin.specialist.view');
    }

    public function edit($id)
    {
        $specialist = Specialist::find($id);
        return view('backend.specialist.edit', compact('specialist'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:specialists,name,'.$id,
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:3048',
        ]);

        $specialist = Specialist::find($id);
        $specialist->name = $request->name;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/specialist/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(64, 64)->save($image_url);

            if(file_exists($specialist->image)){
                unlink($specialist->image);
            }

            $specialist->image = $image_url;
        }

        $specialist->save();

        notify()->success('Specialist Updated', 'Success');
        return redirect()->route('admin.specialist.view');
    }

    public function destroy($id)
    {
        $specialist = Specialist::find($id);
        if(file_exists($specialist->image)){
            unlink($specialist->image);
        }
        $specialist->delete();
        notify()->success("Specialist Deleted","Success");
        return redirect()->back();
    }

    public function status(Request $request)
    {
        $specialist = Specialist::findorFail($request->id);
        $specialist->status = $request->status;
        $specialist->save();
        return response()->json(['messege' => 'success']);
    }


}
