@extends('layouts.backend.app')

@section('title', 'Edit Profile')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.update.profile', $admin->id) }}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control" placeholder="Name">
                                    <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" placeholder="E-Mail">
                                    <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control dropify" data-default-file="{{ file_exists($admin->image) ? url($admin->image) : '' }}"  data-max-file-size="2M" id="image" accept="image/*">
                                    <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                </div>

                                <div class="form-group col-md-10">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->




@endsection

@push('js')

@endpush
