@extends('layouts.frontend.app')

@section('title', 'Edit Profile')

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
                    <div class="card" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        <div class="card-header ">
                            <h3 class="text-center ">Edit Profile</h3>
                        </div>

                        <div class="card-body box-profile">
                            <form id="quickForm" action="{{ route('patient.update.profile', $patient->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $patient->name }}" placeholder="Name" >
                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" readonly class="form-control" id="email" value="{{ $patient->email }}" placeholder="Email" >
                                        <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$patient->phone }}" placeholder="Phone" >
                                        <span style="color:red">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                            <option {{ $patient->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ $patient->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="{{ $patient->dob }}">
                                        <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $patient->address }}" placeholder="Address" >
                                        <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" class="form-control" id="blood_group">
                                            <option {{ $patient->blood_group == 'A-' ? 'selected' : '' }} value="A-">A-</option>
                                            <option {{ $patient->blood_group == 'A+' ? 'selected' : '' }} value="A+">A+</option>
                                            <option {{ $patient->blood_group == 'B-' ? 'selected' : '' }} value="B-">B-</option>
                                            <option {{ $patient->blood_group == 'B+' ? 'selected' : '' }} value="B+">B+</option>
                                            <option {{ $patient->blood_group == 'AB-' ? 'selected' : '' }} value="AB-">AB-</option>
                                            <option {{ $patient->blood_group == 'AB+' ? 'selected' : '' }} value="AB+">AB+</option>
                                            <option {{ $patient->blood_group == 'O-' ? 'selected' : '' }} value="O-">O-</option>
                                            <option {{ $patient->blood_group == 'O+' ? 'selected' : '' }} value="O+">O+</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('patient_blood_group') ? $errors->first('patient_blood_group') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control dropify" data-default-file="{{ file_exists($patient->image) ? url($patient->image) : '' }}"  data-max-file-size="5M" id="image" accept="image/*">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>

                            </form>

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
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    blood_group: {
                        required: true,
                    },

                },
                messages: {

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
