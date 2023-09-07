<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Appointment</title>
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
</head>
<body>
<br>
<div class="content" style="min-height: 205px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-logo">
                                    <img src="{{ asset('public/frontend') }}/assets/img/logo.png" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="invoice-details">
                                    <strong>Order:</strong> #{{ $appointment->id }} <br>
                                    <strong>Appointment Date:</strong> {{ $appointment->appointment_date }} On {{ $appointment->day->name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-info">
                                    <strong class="customer-text">Patient Info</strong>
                                    <p class="invoice-details invoice-details-two">
                                        {{ $appointment->patient_name }} <br>
                                        {{ $appointment->patient_phone }}<br>
                                        {{ $appointment->patient_gender }} <br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-info invoice-info2">
                                    <strong class="customer-text">Doctor Info</strong>
                                    <p class="invoice-details">
                                        {{ $appointment->doctor->name }} <br>
                                        {{ $appointment->doctor->specialist->name }} <br>
                                        {{ $appointment->doctor->degree }} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="invoice-item invoice-table-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>ID</th>
                                            <td>#{{ $appointment->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Doctor</th>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ route('doctor.profile', $appointment->doctor->id) }}" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" width="10%" src="{{ file_exists($appointment->doctor->image) ? url($appointment->doctor->image) : '' }}" alt="{{ $appointment->doctor->name }}">
                                                    </a>
                                                    <a href="{{ route('doctor.profile', $appointment->doctor->id) }}">{{ $appointment->doctor->name }} <span>{{ $appointment->doctor->specialist->name }}</span></a>
                                                </h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Appointment Date</th>
                                            <td>{{ $appointment->appointment_date.' On '.$appointment->day->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Schedule</th>
                                            <td>{{ $appointment->schedule }}</td>
                                        </tr>
                                        <tr>
                                            <th>Clinic Name</th>
                                            <td>{{ $appointment->clinic_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Clinic Address</th>
                                            <td>{{ $appointment->clinic_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fee</th>
                                            <td>{{ $appointment->fees }} BDT</td>
                                        </tr>
                                        <tr>
                                            <th>Appointment Status</th>
                                            <td>
                                                @if($appointment->status == 'Pending')
                                                    <span class="badge badge-pill bg-danger-light">Pending</span>
                                                @else
                                                    <span class="badge badge-pill bg-success-light">Confirmed</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td>{{ $appointment->patient_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Phone</th>
                                            <td>{{ $appointment->patient_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Gender</th>
                                            <td>{{ $appointment->patient_gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birthday</th>
                                            <td>{{ $appointment->patient_dob }}</td>
                                        </tr>
                                        <tr>
                                            <th>Blood Group</th>
                                            <td>{{ $appointment->patient_blood_group }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Method</th>
                                            <td>{{ $appointment->payment_method }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{ $appointment->payment_status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created On</th>
                                            <td>{{ $appointment->created_at->format('Y-m-d  h:m:s') }}</td>
                                        </tr>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span><i>Printing Date : {{ \Carbon\Carbon::now()->format('Y-m-d  g:i:s a') }}</i></span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
