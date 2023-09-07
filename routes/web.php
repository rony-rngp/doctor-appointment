<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index']);
Route::get('/doctor/{id}/profile', [\App\Http\Controllers\Frontend\HomeController::class, 'doctor_profile'])->name('doctor.profile');
Route::get('/doctors', [\App\Http\Controllers\Frontend\HomeController::class, 'doctors'])->name('doctors');
Route::get('/search/doctors', [\App\Http\Controllers\Frontend\HomeController::class, 'search_doctors'])->name('search.doctors');

Route::match(['get', 'post'],'/login', [\App\Http\Controllers\Frontend\PatientController::class, 'login'])->name('login');
Route::match(['get', 'post'],'/register', [\App\Http\Controllers\Frontend\PatientController::class, 'register'])->name('register');

Route::group(['middleware' => 'patient'], function () {

    Route::group(['prefix' => 'patient'], function (){
        Route::get('/dashboard', [\App\Http\Controllers\Frontend\PatientController::class, 'dashboard'])->name('patient.dashboard');
        Route::post('logout', [\App\Http\Controllers\Frontend\PatientController::class, 'logout'])->name('patient.logout');
        Route::get('appointment/details/{id}', [\App\Http\Controllers\Frontend\PatientController::class, 'appointment_details'])->name('appointment.details');
        Route::get('print/appointment/{id}', [\App\Http\Controllers\Frontend\PatientController::class, 'print_appointment'])->name('print.appointment');

        //Profile Routes Are Here----
        Route::prefix('profile')->group(function (){
            Route::get('/view', [\App\Http\Controllers\Frontend\ProfileController::class, 'show'])->name('patient.view.profile');
            Route::get('/edit/{id}', [\App\Http\Controllers\Frontend\ProfileController::class, 'edit'])->name('patient.edit.profile');
            Route::post('/update/{id}', [\App\Http\Controllers\Frontend\ProfileController::class, 'update'])->name('patient.update.profile');
        });

        //Review Routes Are Here----
        Route::prefix('review')->group(function (){
            Route::get('/view', [\App\Http\Controllers\Frontend\ReviewController::class, 'show'])->name('patient.view.review');
            Route::get('/{id}', [\App\Http\Controllers\Frontend\ReviewController::class, 'add'])->name('patient.add.review');
            Route::post('/store/{id}', [\App\Http\Controllers\Frontend\ReviewController::class, 'store'])->name('patient.store.review');
        });

        //-----Change Password
        Route::get('/password/change', [\App\Http\Controllers\Frontend\ProfileController::class, 'show_password'])->name('patient.change.password');
        Route::get('/password/check', [\App\Http\Controllers\Frontend\ProfileController::class, 'check_password'])->name('patient.check.current.password');
        Route::post('/password/update', [\App\Http\Controllers\Frontend\ProfileController::class, 'update_password'])->name('patient.update.password');


    });

    Route::get('/booking/{id}', [\App\Http\Controllers\Frontend\HomeController::class, 'doctor_booking'])->name('doctor.booking');
    Route::get('/check/schedule', [\App\Http\Controllers\Frontend\HomeController::class, 'check_schedule'])->name('check.schedule');
    Route::get('/check/available/schedule', [\App\Http\Controllers\Frontend\HomeController::class, 'check_available_schedule'])->name('check.available.schedule');
    Route::post('/book', [\App\Http\Controllers\Frontend\HomeController::class, 'book'])->name('book');

    //paypal payment----
    Route::get('paypal/payment/charge/get', [\App\Http\Controllers\Frontend\PaypalController::class, 'charge'])->name('charge');
    Route::get('/payment/success', [\App\Http\Controllers\Frontend\PaypalController::class, 'payment_success']);
    Route::get('/payment/error', [\App\Http\Controllers\Frontend\PaypalController::class, 'payment_error']);

    // Payment Routes for bKash
    Route::post('bkash/get-token', [\App\Http\Controllers\Frontend\BkashController::class, 'getToken'])->name('bkash-get-token');
    Route::post('bkash/create-payment', [\App\Http\Controllers\Frontend\BkashController::class, 'createPayment'])->name('bkash-create-payment');
    Route::post('bkash/execute-payment', [\App\Http\Controllers\Frontend\BkashController::class, 'executePayment'])->name('bkash-execute-payment');
    Route::get('bkash/query-payment', [\App\Http\Controllers\Frontend\BkashController::class, 'queryPayment'])->name('bkash-query-payment');
    Route::post('bkash/success', [\App\Http\Controllers\Frontend\BkashController::class, 'bkashSuccess'])->name('bkash-success');


});

Route::get('book', function (){
   return redirect('/');
});

// SSLCOMMERZ
Route::group(['middleware' => 'sslcommerz'], function (){
    Route::post('/success', [\App\Http\Controllers\Frontend\SslcommerzController::class, 'success']);
    Route::post('/fail', [\App\Http\Controllers\Frontend\SslcommerzController::class, 'fail']);
    Route::post('/cancel', [\App\Http\Controllers\Frontend\SslcommerzController::class, 'cancel']);
    Route::post('/ipn', [\App\Http\Controllers\Frontend\SslcommerzController::class, 'ipn']);
});




//Auth::routes();


//----Admin
Route::match(['get', 'post'], '/admin', [\App\Http\Controllers\Backend\AdminController::class, 'admin'])->name('admin');

Route::group(['prefix' => 'admin', 'as' =>'admin.', 'middleware' => 'auth'], function (){

    Route::get('/dashboard', [\App\Http\Controllers\Backend\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/admin/logout', [\App\Http\Controllers\Backend\AdminController::class, 'logout'])->name('logout');


    //Profile Routes Are Here----
    Route::prefix('profile')->group(function (){
        Route::get('/view', [\App\Http\Controllers\Backend\ProfileController::class, 'show'])->name('view.profile');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\ProfileController::class, 'edit'])->name('edit.profile');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\ProfileController::class, 'update'])->name('update.profile');

        //-----Change Password
        Route::get('/password/change', [\App\Http\Controllers\Backend\ProfileController::class, 'show_password'])->name('change.password');
        Route::get('/password/check', [\App\Http\Controllers\Backend\ProfileController::class, 'check_password'])->name('check.current.password');
        Route::post('/password/update', [\App\Http\Controllers\Backend\ProfileController::class, 'update_password'])->name('update.password');

    });

    //-----Specialist Routes----
    Route::group(['prefix' => 'specialist'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\SpecialistController::class, 'show'])->name('specialist.view');
        Route::get('/add', [\App\Http\Controllers\Backend\SpecialistController::class, 'add'])->name('specialist.add');
        Route::post('/store', [\App\Http\Controllers\Backend\SpecialistController::class, 'store'])->name('specialist.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\SpecialistController::class, 'edit'])->name('specialist.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\SpecialistController::class, 'update'])->name('specialist.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\SpecialistController::class, 'destroy'])->name('specialist.destroy');
        Route::get('/status', [\App\Http\Controllers\Backend\SpecialistController::class, 'status'])->name('specialist.status');
    });

    //-----Day Routes----
    Route::group(['prefix' => 'day'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\DayController::class, 'show'])->name('day.view');
       /* Route::get('/add', [\App\Http\Controllers\Backend\DayController::class, 'add'])->name('day.add');
        Route::post('/store', [\App\Http\Controllers\Backend\DayController::class, 'store'])->name('day.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\DayController::class, 'edit'])->name('day.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\DayController::class, 'update'])->name('day.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\DayController::class, 'destroy'])->name('day.destroy');
        Route::get('/status', [\App\Http\Controllers\Backend\DayController::class, 'status'])->name('day.status');*/
    });



    //-----Doctor Routes----
    Route::group(['prefix' => 'doctor'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\DoctorController::class, 'show'])->name('doctor.view');
        Route::get('/add', [\App\Http\Controllers\Backend\DoctorController::class, 'add'])->name('doctor.add');
        Route::post('/store', [\App\Http\Controllers\Backend\DoctorController::class, 'store'])->name('doctor.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\DoctorController::class, 'edit'])->name('doctor.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\DoctorController::class, 'update'])->name('doctor.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\DoctorController::class, 'destroy'])->name('doctor.destroy');
        Route::get('/status', [\App\Http\Controllers\Backend\DoctorController::class, 'status'])->name('doctor.status');
        Route::get('/details', [\App\Http\Controllers\Backend\DoctorController::class, 'details'])->name('doctor.details');
        Route::get('/schedule/{id}', [\App\Http\Controllers\Backend\DoctorController::class, 'schedule'])->name('doctor.schedule');
    });

    //-----Patient Routes----
    Route::group(['prefix' => 'patient'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\PatientController::class, 'show'])->name('patient.view');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\PatientController::class, 'destroy'])->name('patient.destroy');
        Route::get('/details', [\App\Http\Controllers\Backend\PatientController::class, 'details'])->name('patient.details');
        Route::get('/status', [\App\Http\Controllers\Backend\PatientController::class, 'status'])->name('patient.status');
    });


    //-----Appointment Routes----
    Route::group(['prefix' => 'appointment'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\AppointmentController::class, 'show'])->name('appointment.view');
        Route::get('/details/{id}', [\App\Http\Controllers\Backend\AppointmentController::class, 'details'])->name('appointment.details');
        Route::get('print/{id}', [\App\Http\Controllers\Backend\AppointmentController::class, 'print_appointment'])->name('appointment.print');
    });

    //---------WithdrawalMethod Route-------
    Route::group(['prefix' => 'withdrawal-method'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'show'])->name('withdrawal-method.view');
        Route::get('/add', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'add'])->name('withdrawal-method.add');
        Route::post('/store', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'store'])->name('withdrawal-method.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'edit'])->name('withdrawal-method.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'update'])->name('withdrawal-method.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'destroy'])->name('withdrawal-method.destroy');
        Route::get('/status', [\App\Http\Controllers\Backend\WithdrawalMethodController::class, 'status'])->name('withdrawal-method.status');

    });

    //-----Withdraw Routes----
    Route::group(['prefix' => 'withdraw'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\WithdrawController::class, 'show'])->name('withdraw.view');
        Route::post('/status', [\App\Http\Controllers\Backend\WithdrawController::class, 'status'])->name('withdraw.status');
    });

    //-----Settings Routes----
    Route::group(['prefix' => 'settings'], function (){
        Route::get('/', [\App\Http\Controllers\Backend\SettingsController::class, 'show'])->name('settings.view');
        Route::post('/update', [\App\Http\Controllers\Backend\SettingsController::class, 'update'])->name('settings.update');
    });


    //---------CMS Route-------
    Route::group(['prefix' => 'cms'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\CmsController::class, 'show'])->name('cms.view');
        Route::get('/add', [\App\Http\Controllers\Backend\CmsController::class, 'add'])->name('cms.add');
        Route::post('/store', [\App\Http\Controllers\Backend\CmsController::class, 'store'])->name('cms.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\CmsController::class, 'edit'])->name('cms.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\CmsController::class, 'update'])->name('cms.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\CmsController::class, 'destroy'])->name('cms.destroy');
        Route::get('/status', [\App\Http\Controllers\Backend\CmsController::class, 'status'])->name('cms.status');

    });

    //-----Withdraw Routes----
    Route::group(['prefix' => 'review'], function (){
        Route::get('/list', [\App\Http\Controllers\Backend\ReviewController::class, 'show'])->name('review.view');
        Route::get('/details', [\App\Http\Controllers\Backend\ReviewController::class, 'details'])->name('review.details');
        Route::get('/status', [\App\Http\Controllers\Backend\ReviewController::class, 'status'])->name('review.status');
    });



});

//---------Doctor---------
Route::match(['get', 'post'], '/doctor/login', [\App\Http\Controllers\Doctor\DoctorController::class, 'doctor_login'])->name('doctor.login');

Route::group(['prefix' => 'doctor', 'as' =>'doctor.', 'middleware' => 'doctor'], function (){
    Route::get('/dashboard', [\App\Http\Controllers\Doctor\DoctorController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [\App\Http\Controllers\Doctor\DoctorController::class, 'logout'])->name('logout');

    //Profile Routes Are Here----
    Route::prefix('profile')->group(function (){
        Route::get('/view', [\App\Http\Controllers\Doctor\ProfileController::class, 'show'])->name('view.profile');
        Route::get('/edit/{id}', [\App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('edit.profile');
        Route::post('/update/{id}', [\App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('update.profile');
    });

    //-----Schedule Routes----
    Route::group(['prefix' => 'schedule'], function (){
        Route::get('/view', [\App\Http\Controllers\Doctor\ScheduleController::class, 'show'])->name('schedule.view');
        Route::get('/add', [\App\Http\Controllers\Doctor\ScheduleController::class, 'add'])->name('schedule.add');
        Route::post('/store', [\App\Http\Controllers\Doctor\ScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'update'])->name('schedule.update');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'destroy'])->name('schedule.destroy');
        Route::get('/status', [\App\Http\Controllers\Doctor\ScheduleController::class, 'status'])->name('schedule.status');
        Route::get('/details', [\App\Http\Controllers\Doctor\ScheduleController::class, 'details'])->name('schedule.details');
    });


    //-----Appointment Routes----
    Route::group(['prefix' => 'appointment'], function (){
        Route::get('/view', [\App\Http\Controllers\Doctor\AppointmentController::class, 'show'])->name('appointment.view');
        Route::get('/details/{id}', [\App\Http\Controllers\Doctor\AppointmentController::class, 'details'])->name('appointment.details');
        Route::post('/update/{id}', [\App\Http\Controllers\Doctor\AppointmentController::class, 'update'])->name('appointment.update');
        Route::get('/check/otp', [\App\Http\Controllers\Doctor\AppointmentController::class, 'check_opt'])->name('appointment.check.otp');
    });

    //-----Appointment Routes----
    Route::group(['prefix' => 'withdraw'], function (){
        Route::get('/add', [\App\Http\Controllers\Doctor\WithdrawController::class, 'add'])->name('withdraw.add');
        Route::get('/list', [\App\Http\Controllers\Doctor\WithdrawController::class, 'withdraw_list'])->name('withdraw.list');
        Route::get('/check/account/type', [\App\Http\Controllers\Doctor\WithdrawController::class, 'check_account_type'])->name('withdraw.check_account_type');
        Route::post('/store', [\App\Http\Controllers\Doctor\WithdrawController::class, 'store'])->name('withdraw.store');
    });


    //-----Change Password
    Route::get('/password/change', [\App\Http\Controllers\Doctor\ProfileController::class, 'show_password'])->name('change.password');
    Route::get('/password/check', [\App\Http\Controllers\Doctor\ProfileController::class, 'check_password'])->name('check.current.password');
    Route::post('/password/update', [\App\Http\Controllers\Doctor\ProfileController::class, 'update_password'])->name('update.password');

});


Route::get('{slug}', [\App\Http\Controllers\Frontend\HomeController::class, 'cms'])->name('cms');

