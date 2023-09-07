<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function show()
    {
        $withdraws = Withdraw::latest()->get();
        return view('backend.withdraw.view', compact('withdraws'));
    }

    public function status(Request $request)
    {
        $this->validate($request, [
           'status' => 'required'
        ]);

        if($request->status == 0 || $request->status == 1 ){

            $withdraw = Withdraw::findOrFail($request->id);
            if ($withdraw->status == 0){

                if ($withdraw->status != $request->status){

                    $withdraw->status = $request->status;
                    $withdraw->save();
                    notify()->success("Status successfully updated", 'Success');
                    return redirect()->back();

                }else{
                    notify()->error("Sorry! You can't update same status", 'Error');
                    return redirect()->back();
                }

            }else{
                notify()->error('Sorry ! Status already updated', 'Error');
                return redirect()->back();
            }

        }else{
            notify()->error("Don't try to over smart", 'Error');
            return redirect()->back();
        }
    }
}
