@extends('layouts.frontend.app')

@section('title', 'Patient Register')

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
                            <li class="breadcrumb-item active" aria-current="page">Patient Register</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Patient Register</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">

                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-12 login-right">
                                <div class="login-header">
                                    <h3>Patient <span>Registration</span></h3>
                                </div>
                                <form action="{{ route('register') }}" id="quickForm" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name" >
                                            <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" >
                                            <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone" >
                                            <span style="color:red">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" id="gender">
                                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                            <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                                            <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Address" >
                                            <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="blood_group">Blood Group</label>
                                            <select name="blood_group" class="form-control" id="blood_group">
                                                <option {{ old('blood_group') == 'A-' ? 'selected' : '' }} value="A-">A-</option>
                                                <option {{ old('blood_group') == 'A+' ? 'selected' : '' }} value="A+">A+</option>
                                                <option {{ old('blood_group') == 'B-' ? 'selected' : '' }} value="B-">B-</option>
                                                <option {{ old('blood_group') == 'B+' ? 'selected' : '' }} value="B+">B+</option>
                                                <option {{ old('blood_group') == 'AB-' ? 'selected' : '' }} value="AB-">AB-</option>
                                                <option {{ old('blood_group') == 'AB+' ? 'selected' : '' }} value="AB+">AB+</option>
                                                <option {{ old('blood_group') == 'O-' ? 'selected' : '' }} value="O-">O-</option>
                                                <option {{ old('blood_group') == 'O+' ? 'selected' : '' }} value="O+">O+</option>
                                            </select>
                                            <span style="color:red">{{ $errors->has('blood_group') ? $errors->first('blood_group') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="image">Image (Optional)</label>
                                            <input type="file" name="image" class="form-control" data-max-file-size="5M" id="image" accept="image/*">
                                            <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                                            <span style="color:red">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password" >
                                            <span style="color:red">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                                        </div>



                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>



                                    <div class="text-center dont-have">Have have an account? <a href="{{ route('login') }}">Login</a></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>

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
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
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

