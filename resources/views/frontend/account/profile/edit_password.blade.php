@extends('layouts.frontend.app')

@section('title', 'Change Password')

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
                        <div class="card-header">
                            <h3 class="float-left">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('patient.update.password') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                                        <span style="color:red">{{ $errors->has('current_password') ? $errors->first('current_password') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                                        <span style="color:red">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        <span style="color:red">{{ $errors->has('password_confirmation') ? 'The confirm password field is required.' : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
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
                    current_password: {
                        required: true,
                        remote : "{{ route('patient.check.current.password') }}",
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
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
