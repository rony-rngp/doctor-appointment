<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function add()
    {
        $withdrawal_methods = WithdrawalMethod::where('status', 1)->get();
        return view('doctor.withdraw.add', compact('withdrawal_methods'));
    }

    public function check_account_type(Request $request)
    {
        $withdrawal_method = WithdrawalMethod::where('name', $request->name)->firstOrFail();
        if ($withdrawal_method->account_type == null){
            return response()->json([
                'status' => false,
                'account_type' => ''
            ]);
        }else{
            $account_type = explode(',', $withdrawal_method->account_type);
            return response()->json([
                'status' => true,
                'account_type' => $account_type
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'payment_method' => 'required',
           'amount' => 'required|numeric',
           'account_number' => 'required|numeric',
        ]);

        $withdrawal_method = WithdrawalMethod::where('name', $request->payment_method)->firstOrFail();
        if ($withdrawal_method->account_type != null){
            if($request->account_type == null){
                notify()->error('Filed must not be empty', 'Error');
                return redirect()->back();
            }

        }

        if ($request->amount < 10){
            notify()->error('Minimum withdraw amount 10');
            return redirect()->back();
        }

        $doctor = Auth::guard('doctor')->user();

        if ($doctor->amount >= $request->amount){

            $withdraw = new Withdraw();
            $withdraw->doctor_id = $doctor->id;
            $withdraw->payment_method = $request->payment_method;
            $withdraw->account_type = $request->account_type;
            $withdraw->amount = $request->amount;
            $withdraw->account_number = $request->account_number;
            $withdraw->status = 0;
            $withdraw->save();

            //----Reduce Balance---
            $doctor->amount = $doctor->amount - $request->amount;
            $doctor->save();

            notify()->success('Your Withdraw Successfully Completed');
            return redirect()->back();

        }else{
            notify()->error('Not enough balance');
            return redirect()->back();
        }
    }

    public function withdraw_list()
    {
        $withdraws = Withdraw::where('doctor_id', Auth::guard('doctor')->user()->id)->latest()->get();
        return view('doctor.withdraw.list', compact('withdraws'));
    }
}
