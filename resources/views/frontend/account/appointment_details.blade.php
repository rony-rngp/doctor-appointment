@extends('layouts.frontend.app')

@section('title', 'Appointment Details')

@push('css')

@endpush

@section('content')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content" style="transform: none; min-height: 205px;">
        <div class="container-fluid" style="transform: none;">
            <div class="row" style="transform: none;">

                @include('frontend.account.sidebar')

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body pt-0">

                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointment Details</a>
                                    </li>
                                </ul>
                            </nav>


                            <div class="tab-content pt-0">

                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
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
                                                                    <img class="avatar-img rounded-circle" src="{{ file_exists($appointment->doctor->image) ? url($appointment->doctor->image) : '' }}" alt="{{ $appointment->doctor->name }}">
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

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')


@endpush

