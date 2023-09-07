@extends('layouts.backend.app')

@section('title', 'Appointment Details')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Appointment Details
                    </div>
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
                                        <p class="table-avatar">
                                            <a href="{{ route('doctor.profile', $appointment->doctor->id) }}" class="avatar avatar-sm mr-2">
                                                <img class="avatar-img" width="10%" src="{{ file_exists($appointment->doctor->image) ? url($appointment->doctor->image) : '' }}" alt="{{ $appointment->doctor->name }}">
                                            </a>
                                            <a href="{{ route('doctor.profile', $appointment->doctor->id) }}">{{ $appointment->doctor->name }} <span>{{ $appointment->doctor->specialist->name }}</span></a>
                                        </p>
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
                                    <td>{{ $appointment->fees }}</td>
                                </tr>
                                <tr>
                                    <th>Appointment Status</th>
                                    <td>
                                        @if($appointment->status == 'Pending')
                                            <span class="badge badge-danger">Pending</span>
                                        @else
                                            <span class="badge badge-success">Confirmed</span>
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
                                    <th>Transaction ID</th>
                                    <td>{{ $appointment->transaction_id }}</td>
                                </tr>
                                <tr>
                                    <th>Created On</th>
                                    <td>{{ $appointment->created_at->format('Y-m-d  h:m:s') }}</td>
                                </tr>


                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->



@endsection

@push('js')

@endpush
