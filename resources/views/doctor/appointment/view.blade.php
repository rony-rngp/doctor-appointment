@extends('layouts.doctor.app')

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
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('doctor.schedule.add') }}"><i class="fa fa-plus-square"></i> Add Schedule</a></p>
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Appointment Date</th>
                                <th>ID</th>
                                <th>Clinic Name</th>
                                <th>Clinic Address</th>
                                <th>Time</th>
                                <th>Fees</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($appointments as $key => $appointment)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $appointment->appointment_date }} <span class="d-block text-info">{{ $appointment->day->name }}</span></td>
                                    <td>#{{ $appointment->id }}</td>
                                    <td>{{ $appointment->clinic_name }}</td>
                                    <td>{{ $appointment->clinic_address }}</td>
                                    <td>{{ $appointment->schedule }}</td>
                                    <td>{{ $appointment->fees }} BDT</td>
                                    <td>
                                        @if($appointment->status == 'Pending')
                                            <p class="badge badge-danger">Pending</p>
                                        @else
                                            <p class="badge badge-success">Confirmed</p>
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ route('doctor.appointment.details', $appointment->id) }}" title="Details" class="btn btn-sm btn-success"> <i class="fa fa-eye"></i></a>

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
