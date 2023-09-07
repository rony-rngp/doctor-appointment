@extends('layouts.backend.app')

@section('title', 'Profile')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="text-center ">My Profile</h3>
                    </div>

                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img" src="{{ file_exists($admin->image) ? url($admin->image) : asset('public/backend/upload/avatar.png') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                        <table class="table  table-bordered">
                            <tbody>

                            <tr>
                                <td>Name</td>

                                <td>{{ $admin->name }}</td>
                            </tr>

                            <tr>
                                <td>E-Mail</td>

                                <td>{{ $admin->email }}</td>
                            </tr>

                            </tbody>
                        </table>

                        <a href="{{ route('admin.edit.profile',$admin->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->




@endsection

@push('js')

@endpush
