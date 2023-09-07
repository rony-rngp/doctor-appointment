<?php

namespace App\Models;

use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SSLCommerz extends Model
{
    use HasFactory;

    public static function getPayment($details)
    {
        $post_data = array();
        $post_data['total_amount'] = $details->fees; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $details->patient_name;
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = '';
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $details->patient_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $details->patient_name;
        $post_data['ship_add1'] = "optional";
        $post_data['ship_add2'] = "optional";
        $post_data['ship_city'] = "optional";
        $post_data['ship_state'] = "optional";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = $details->patient_phone;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "optional";
        $post_data['product_category'] = "optional";
        $post_data['product_profile'] = "optional";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = csrf_token();;
        $post_data['value_b'] = Auth::guard('patient')->user()->id;

        $post_data['value_c'] = $details->patient_id.'___+++'.$details->doctor_id.'___+++'.$details->schedule_id.'___+++'.$details->day_id
        .'___+++'.$details->appointment_date.'___+++'.$details->fees.'___+++'.$details->clinic_name.'___+++'.$details->clinic_address.'___+++'.$details->schedule
        .'___+++'.$details->patient_name.'___+++'.$details->patient_phone.'___+++'.$details->patient_gender.'___+++'.$details->patient_dob.'___+++'.$details->patient_blood_group
        .'___+++'.$post_data['tran_id'];

        $post_data['value_d'] = "ref004";

        $test = explode('___+++', $post_data['value_c']);
        if (count($test) == 15){
            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }

        }else{
            echo 'Something went to wrong. <a href="'.url('/').'">Home</a>';
        }








    }
}
