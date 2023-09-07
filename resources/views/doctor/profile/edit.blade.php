@extends('layouts.doctor.app')

@section('title', 'Edit Doctor')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Edit Doctor
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('doctor.update.profile', $doctor->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="specialist_id">Specialization</label>
                                    <select name="specialist_id" class="form-control" id="specialist_id">
                                        <option value="">Choose Specialization</option>
                                        @foreach($specialists as $specialist)
                                            <option {{ $doctor->specialist_id == $specialist->id ? 'selected' : '' }} value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->has('specialist_id') ? $errors->first('specialist_id') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" placeholder="Name" >
                                    <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" placeholder="Email" >
                                    <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$doctor->phone }}" placeholder="Phone" >
                                    <span style="color:red">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option {{ $doctor->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                        <option {{ $doctor->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                    </select>
                                    <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ $doctor->dob }}">
                                    <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="clinic">Clinic or Hospital Name</label>
                                    <input type="text" class="form-control" id="clinic" name="clinic" value="{{ $doctor->clinic }}" placeholder="Clinic or Hospital Name" >
                                    <span style="color:red">{{ $errors->has('clinic') ? $errors->first('clinic') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="clinic_address">Clinic or Hospital Address</label>
                                    <input type="text" class="form-control" id="clinic_address" name="clinic_address" value="{{ $doctor->clinic_address }}" placeholder="Clinic or Hospital Address" >
                                    <span style="color:red">{{ $errors->has('clinic_address') ? $errors->first('clinic_address') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fees">Fees</label>
                                    <input type="text" class="form-control" id="fees" name="fees" value="{{ $doctor->fees }}" placeholder="Fees" >
                                    <span style="color:red">{{ $errors->has('fees') ? $errors->first('fees') : '' }}</span>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="degree">Degree</label>
                                    <input type="text" class="form-control" id="degree" name="degree" value="{{ $doctor->degree }}" placeholder="Degree" >
                                    <span style="color:red">{{ $errors->has('degree') ? $errors->first('degree') : '' }}</span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="about">About</label>
                                    <textarea rows="5" class="form-control" name="about" id="about">{{ $doctor->about }}</textarea>
                                    <span style="color:red">{{ $errors->has('about') ? $errors->first('about') : '' }}</span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control dropify" data-default-file="{{ file_exists($doctor->image) ? url($doctor->image) : '' }}"  data-max-file-size="5M" id="image" accept="image/*">
                                    <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                </div>

                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>

                        </form>

                    </div> <!-- end card-body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->

@endsection

@push('js')

    <script>
        $(function () {

            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    specialist_id: {
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
                    clinic: {
                        required: true,
                    },
                    clinic_address: {
                        required: true,
                    },
                    fees: {
                        required: true,
                        number: true
                    },
                    degree: {
                        required: true,
                    },
                    about: {
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
