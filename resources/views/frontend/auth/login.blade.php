@extends('layouts.frontend.app')

@section('title', 'Patient Login')

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
                            <li class="breadcrumb-item active" aria-current="page">Patient Login</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Patient Login</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ asset('public/frontend') }}/assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Login <span>Patient</span></h3>
                                </div>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control floating">
                                        <label class="focus-label">Email</label>
                                        <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="password" name="password" class="form-control floating">
                                        <label class="focus-label">Password</label>
                                        <span style="color:red">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                    </div>
                                    <div class="text-right">
                                        <a class="forgot-link" href="#">Forgot Password ?</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">or</span>
                                    </div>
                                    <div class="text-center dont-have">Don’t have an account? <a href="{{ route('register') }}">Register</a></div>
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


@endpush

