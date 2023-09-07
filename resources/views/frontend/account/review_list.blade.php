@extends('layouts.frontend.app')

@section('title', 'Review List')

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
                            <li class="breadcrumb-item active" aria-current="page">Review</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Review List</h2>
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
                                        <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Review List ( {{ $reviews->count() }} )</a>
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
                                                        <th>Appointment</th>
                                                        <th>Doctor</th>
                                                        <th>Appointment Date</th>
                                                        <th>Ratting</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($reviews as $key => $review)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td><a href="{{ route('appointment.details', $review->appointment->id) }}"><u>Click Here</u></a></td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="{{ route('doctor.profile', $review->appointment->doctor->id) }}" class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle" src="{{ file_exists($review->appointment->doctor->image) ? url($review->appointment->doctor->image) : '' }}" alt="{{ $review->appointment->doctor->name }}">
                                                                    </a>
                                                                    <a href="{{ route('doctor.profile', $review->appointment->doctor->id) }}">{{ $review->appointment->doctor->name }} <span>{{ $review->appointment->doctor->specialist->name }}</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>{{ $review->appointment->appointment_date }} <span class="d-block text-info">{{ $review->appointment->day->name }}</span></td>

                                                            <td>
                                                                <div class="rating">
                                                                    <?php
                                                                    for ($x = 1; $x <= $review->ratting; $x++) {
                                                                        echo '<i class="fas fa-star filled"></i>';
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </td>

                                                            <td>
                                                                @if($review->status == 0)
                                                                    <span class="badge badge-pill bg-danger-light">Pending</span>
                                                                @else
                                                                    <span class="badge badge-pill bg-success-light">Confirmed</span>
                                                                @endif
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

