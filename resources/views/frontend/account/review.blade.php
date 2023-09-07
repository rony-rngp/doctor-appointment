@extends('layouts.frontend.app')

@section('title', 'Add Review')

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
                    <h2 class="breadcrumb-title">Add Review</h2>
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
                        <div class="card-header">
                            <h3 class="float-left">Add Review</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <form id="quickForm" action="{{ route('patient.store.review', $appointment->id) }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label>Ratting</label>
                                            <select name="ratting" class="selectpicker show-menu-arrow show-tick form-control">
                                                <option value="">- select rating -</option>
                                                <option value="5">★★★★★ - Excellent</option>
                                                <option value="4">★★★★ - Very Good</option>
                                                <option value="3">★★★ - Good</option>
                                                <option value="2">★★ - Fair</option>
                                                <option value="1">★ - Poor</option>
                                            </select>
                                            <span style="color:red">{{ $errors->has('ratting') ? $errors->first('ratting') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Review Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Review Title" value="{{ old('title') }}">
                                            <span style="color:red">{{ $errors->has('review') ? $errors->first('review') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="review">Your review</label>
                                            <textarea name="review" rows="6" class="form-control" id="review" placeholder="please leave your feedback about us..." spellcheck="false">{{ old('review') }}</textarea>
                                            <span style="color:red">{{ $errors->has('review') ? $errors->first('review') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg">Add Feedback</button>
                                        </div>
                                    </form>
                                </div>



                                <div class="col-md-6">
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
@endsection

@push('js')
    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    ratting: {
                        required: true,
                        number : true
                    },
                    title: {
                        required: true,
                    },
                    review: {
                        required: true,
                    },

                },
                messages: {
                    current_password: {
                        remote: "Current password is wrong (:",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
