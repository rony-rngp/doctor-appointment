@extends('layouts.frontend.app')

@section('title', 'Patient Dashboard')

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
                                        <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments ( {{ $appointments->count() }} )</a>
                                    </li>
                                </ul>
                            </nav>


                            <div class="tab-content pt-0">

                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Doctor</th>
                                                        <th>ID</th>
                                                        <th>Appointment Date</th>
                                                        <th>Schedule</th>
                                                        <th>Clinic Name</th>
                                                        <th>Clinic Address</th>
                                                        <th>Fee</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($appointments as $key => $appointment)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{ route('doctor.profile', $appointment->doctor->id) }}" class="avatar avatar-sm mr-2">
                                                                    <img class="avatar-img rounded-circle" src="{{ file_exists($appointment->doctor->image) ? url($appointment->doctor->image) : '' }}" alt="{{ $appointment->doctor->name }}">
                                                                </a>
                                                                <a href="{{ route('doctor.profile', $appointment->doctor->id) }}">{{ $appointment->doctor->name }} <span>{{ $appointment->doctor->specialist->name }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>#{{ $appointment->id }}</td>
                                                        <td>{{ $appointment->appointment_date }} <span class="d-block text-info">{{ $appointment->day->name }}</span></td>
                                                        <td>{{ $appointment->schedule }}</td>
                                                        <td>{{ $appointment->clinic_name }}</td>
                                                        <td>{{ $appointment->clinic_address }}</td>
                                                        <td>{{ $appointment->fees }} BDT</td>
                                                        <td>
                                                            @if($appointment->status == 'Pending')
                                                            <span class="badge badge-pill bg-danger-light">Pending</span>
                                                            @else
                                                            <span class="badge badge-pill bg-success-light">Confirmed</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="table-action">
                                                                <a target="_blank" href="{{ route('print.appointment', $appointment->id) }}" class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> Print
                                                                </a>
                                                                <a href="{{ route('appointment.details', $appointment->id) }}" class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> View
                                                                </a>
                                                                <a href="{{ route('patient.add.review', $appointment->id) }}" class="btn btn-sm bg-warning-light">
                                                                    <i class="far fa-star"></i> Review
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
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

