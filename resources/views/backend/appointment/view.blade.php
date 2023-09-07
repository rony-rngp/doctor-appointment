@extends('layouts.backend.app')

@section('title', 'Appointment List')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Appointment List ({{ $appointments->count() }})
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Doctor</th>
                                <th>ID</th>
                                <th>Appointment Date</th>
                                <th>Clinic Name</th>
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
                                        <p class="table-avatar">
                                            <a target="_blank" href="{{ route('doctor.profile', $appointment->doctor->id) }}">
                                                <img width="20%" class="avatar-img" src="{{ file_exists($appointment->doctor->image) ? url($appointment->doctor->image) : '' }}" alt="{{ $appointment->doctor->name }}">
                                            </a>
                                            <a target="_blank" href="{{ route('doctor.profile', $appointment->doctor->id) }}">{{ $appointment->doctor->name }} </a>
                                        </p>
                                    </td>
                                    <td>#{{ $appointment->id }}</td>
                                    <td>{{ $appointment->appointment_date }} <span class="d-block text-info">{{ $appointment->day->name }}</span></td>
                                    <td>{{ $appointment->clinic_name }}</td>
                                    <td>{{ $appointment->fees }}</td>
                                    <td>
                                        @if($appointment->status == 'Pending')
                                            <span class="badge badge-danger">Pending</span>
                                        @else
                                            <span class="badge badge-success">Confirmed</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="table-action">
                                            <a href="{{ route('admin.appointment.details', $appointment->id) }}" class="btn btn-sm btn-info">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a target="_blank" href="{{ route('admin.appointment.print', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-print"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->



@endsection

@push('js')

@endpush
