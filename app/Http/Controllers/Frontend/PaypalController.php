<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;


class PaypalController extends Controller
{

    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('ASQC-9fJrrvx-IiRSI7DTqRbZOEXvzTqc4ypkamm9tF_m3XSpK_ZUYexTfBttvdmt3jhtAE6-tnxgHI6');
        $this->gateway->setSecret('EIhFzqNIx2swRP0hturfcyO-AmpnUEQL4IDB60tEdzNGbxtsBFoUTjttqJIblIqinb3oMc9JCztiAxEs');
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function charge()
    {

        if (!Session::has('appointment')){
            return redirect()->back();
        }

        $appointment = Session::get('appointment');

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $appointment->fees,
                'currency' => 'USD',
                'returnUrl' => url('payment/success'),
                'cancelUrl' => url('payment/error'),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function payment_success(Request $request)
    {
        if (!Session::has('appointment')){
            return redirect()->back();
        }
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();


                // Insert transaction data into the database
                $isPaymentExist = Appointment::where('transaction_id', $arr_body['id'])->first();

                if(!$isPaymentExist)
                {

                    $details = Session::get('appointment');

                    $appointment = new Appointment();
                    $appointment->patient_id = $details->patient_id;
                    $appointment->doctor_id = $details->doctor_id;
                    $appointment->schedule_id  = $details->schedule_id;
                    $appointment->day_id = $details->day_id;
                    $appointment->appointment_date = $details->appointment_date;
                    $appointment->fees = $details->fees;
                    $appointment->clinic_name = $details->clinic_name;
                    $appointment->clinic_address = $details->clinic_address;
                    $appointment->schedule = $details->schedule;
                    $appointment->patient_name = $details->patient_name;
                    $appointment->patient_phone = $details->patient_phone;
                    $appointment->patient_gender = $details->patient_gender;
                    $appointment->patient_dob = $details->patient_dob;
                    $appointment->patient_blood_group = $details->patient_blood_group;
                    $appointment->payment_method = $details->payment_method;
                    $appointment->payment_status = 'Complete';
                    $appointment->transaction_id = $arr_body['id'];
                    $appointment->status = 'Pending';
                    $appointment->save();

                    Session::forget('appointment');

                    notify()->success('Appointment Successfully Completed', 'Success');
                    return redirect()->route('patient.dashboard');


                }

            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        if (!Session::has('appointment')){
            return redirect()->back();
        }
        return 'User is canceled the payment.';
    }



}
