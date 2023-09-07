@extends('layouts.doctor.app')

@section('title', 'Profile')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                    <div class="card-header ">
                        <h3 class="text-center ">My Profile</h3>
                    </div>

                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img" width="20%" src="{{ $doctor->image ? URL($doctor->image) : asset('public/backend/upload/avatar.png') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $doctor->name }}</h3>

                        <table class="table  table-bordered" >
                            <tr>
                                <td>Name</td>
                                <td>{{ $doctor->name }}</td>
                            </tr>

                            <tr>
                                <td>Specialist</td>
                                <td>{{ $doctor->specialist->name }}</td>
                            </tr>

                            <tr>
                                <td>Fee</td>
                                <td>{{ $doctor->fees }}</td>
                            </tr>

                            <tr>
                                <td>Degree</td>
                                <td>{{ $doctor->degree }}</td>
                            </tr>


                            <tr>
                                <td>E-Mail</td>
                                <td>{{ $doctor->email }}</td>
                            </tr>

                            <tr>
                                <td>Phone</td>
                                <td>{{ $doctor->phone }}</td>
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td>{{ $doctor->gender }}</td>
                            </tr>

                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ $doctor->dob }}</td>
                            </tr>

                            <tr>
                                <td>Clinic or Hospital</td>
                                <td>{{ $doctor->clinic }}</td>
                            </tr>

                            <tr>
                                <td>Clinic or Hospital Address</td>
                                <td>{{ $doctor->clinic_address }}</td>
                            </tr>


                            <tr>
                                <td>Password</td>
                                <td>{{ $doctor->show_password }}</td>
                            </tr>

                        </table><br>

                        <a href="{{ route('doctor.edit.profile', $doctor->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->



@endsection

@push('js')

@endpush
