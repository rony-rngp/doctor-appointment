@extends('layouts.frontend.app')

@section('title', 'Profile')

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
                            <h3 class="text-center ">My Profile</h3>
                        </div>

                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img" width="15%" src="{{ file_exists($patient->image) ? URL($patient->image) : asset('public/backend/upload/avatar.png') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $patient->name }}</h3>

                            <table class="table  table-bordered" >
                                <tbody>

                                <tr>
                                    <td>Name</td>
                                    <td>{{ $patient->name }}</td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td>{{ $patient->email }}</td>
                                </tr>

                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $patient->phone }}</td>
                                </tr>

                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $patient->gender }}</td>
                                </tr>


                                <tr>
                                    <td>Date of Birth</td>
                                    <td>{{ $patient->dob }}</td>
                                </tr>

                                <tr>
                                    <td>Address</td>
                                    <td>{{ $patient->address }}</td>
                                </tr>

                                <tr>
                                    <td>Blood Group</td>
                                    <td>{{ $patient->blood_group }}</td>
                                </tr>


                                </tbody>

                            </table><br>

                            <a href="{{ route('patient.edit.profile', $patient->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
