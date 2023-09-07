<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function show()
    {
        $days = Day::all();
        return view('backend.day.view', compact('days'));
    }

    public function add()
    {
        return view('backend.day.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:days'
        ]);

        $day = new Day();
        $day->name = $request->name;
        $day->save();

        notify()->success('Day Added', 'Success');
        return redirect()->route('admin.day.view');
    }

    public function edit($id)
    {
        $day = Day::findOrFail($id);
        return view('backend.day.edit', compact('day'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|unique:days,name,'.$id
        ]);

        $day = Day::findOrFail($id);
        $day->name = $request->name;
        $day->save();

        notify()->success('Day Updated', 'Success');
        return redirect()->route('admin.day.view');
    }

    public function destroy($id)
    {
        $day = Day::findOrFail($id);
        $day->delete();
        notify()->success('Day Deleted', 'Success');
        return redirect()->back();
    }
}
