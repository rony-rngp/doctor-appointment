<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SslcommerzController extends Controller
{


    public function success(Request $request)
    {

        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $data = explode('___+++', $request->value_c);


        $appointment = new Appointment();
        $appointment->patient_id = $data[0];
        $appointment->doctor_id = $data[1];
        $appointment->schedule_id  = $data[2];
        $appointment->day_id = $data[3];
        $appointment->appointment_date = $data[4];
        $appointment->fees = $data[5];
        $appointment->clinic_name = $data[6];
        $appointment->clinic_address = $data[7];
        $appointment->schedule = $data[8];
        $appointment->patient_name = $data[9];
        $appointment->patient_phone = $data[10];
        $appointment->patient_gender = $data[11];
        $appointment->patient_dob = $data[12];
        $appointment->patient_blood_group = $data[13];
        $appointment->payment_method = 'Sslcommerz';
        $appointment->payment_status = 'Complete';
        $appointment->transaction_id = $tran_id;
        $appointment->currency = $currency;
        $appointment->status = 'Pending';
        $appointment->save();

        notify()->success('Appointment Successfully Completed', 'Success');
        return redirect()->route('patient.dashboard');


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('appointments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'payment_status', 'currency', 'fees')->first();

        if ($order_detials != null){
            if ($order_detials->payment_status == 'Pending') {
                $update_product = DB::table('appointments')
                    ->where('transaction_id', $tran_id)
                    ->update(['payment_status' => 'Failed']);
                echo "Transaction is Falied";
            } else if ($order_detials->payment_status == 'Complete') {
                echo "Transaction is already Successful";
            } else {
                echo "Transaction is Invalid";
            }
        }else{
            notify()->error('Payment Failed', 'Error');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('appointments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'payment_status', 'currency', 'fees')->first();

        if ($order_detials != null){
            if ($order_detials->status == 'Pending') {
                $update_product = DB::table('appointments')
                    ->where('transaction_id', $tran_id)
                    ->update(['payment_status' => 'Canceled']);
                echo "Transaction is Cancel";
            } else if ($order_detials->status == 'Complete') {
                echo "Transaction is already Successful";
            } else {
                echo "Transaction is Invalid";
            }
        }else{
            notify()->error('Payment Failed', 'Error');
            return redirect()->back();
        }




    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('appointments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'payment_status', 'fees', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('appointments')
                        ->where('transaction_id', $tran_id)
                        ->update(['payment_status' => 'Complete']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('appointments')
                        ->where('transaction_id', $tran_id)
                        ->update(['payment_status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
