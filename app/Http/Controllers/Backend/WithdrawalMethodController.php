<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;

class WithdrawalMethodController extends Controller
{
    public function show()
    {
        $withdrawal_methods = WithdrawalMethod::all();
        return view('backend.withdrawal_method.view', compact('withdrawal_methods'));
    }

    public function add()
    {
        return view('backend.withdrawal_method.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
        ]);

        $withdrawal_method = new WithdrawalMethod();
        $withdrawal_method->name = $request->name;
        $withdrawal_method->account_type = $request->account_type;
        $withdrawal_method->status = 1;
        $withdrawal_method->save();
        notify()->success('Withdrawal Method Added', 'Success');
        return redirect()->route('admin.withdrawal-method.view');
    }

    public function edit($id)
    {
        $withdrawal_method = WithdrawalMethod::findOrFail($id);
        return view('backend.withdrawal_method.edit', compact('withdrawal_method'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $withdrawal_method = WithdrawalMethod::findOrFail($id);
        $withdrawal_method->name = $request->name;
        $withdrawal_method->account_type = $request->account_type;
        $withdrawal_method->save();
        notify()->success('Withdrawal Method Updated', 'Success');
        return redirect()->route('admin.withdrawal-method.view');
    }

    public function destroy($id)
    {
        $withdrawal_method = WithdrawalMethod::findOrFail($id);
        $withdrawal_method->delete();
        notify()->success('Withdrawal Method Deleted', 'Success');
        return redirect()->route('admin.withdrawal-method.view');
    }

    public function status(Request $request)
    {
        $withdrawal_method = WithdrawalMethod::findOrFail($request->id);
        $withdrawal_method->status = $request->status;
        $withdrawal_method->save();
        return response()->json(['Message' => 'Success']);

    }
}
