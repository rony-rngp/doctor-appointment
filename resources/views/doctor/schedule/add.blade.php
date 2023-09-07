@extends('layouts.doctor.app')

@section('title', 'Add Schedule')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Add Schedule
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('doctor.schedule.view') }}"><i class="fa fa-list-alt"></i> Schedule List</a></p>
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('doctor.schedule.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="day_id">Day</label>
                                    <select name="day_id" class="form-control" id="day_id">
                                        <option value="">Choose Day</option>
                                        @foreach($days as $day)
                                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->has('day_id') ? $errors->first('day_id') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="clinic_name">Clinic or Hospital Name</label>
                                    <input type="text" class="form-control" id="clinic_name" name="clinic_name" value="{{ old('clinic_name') }}" placeholder="Clinic or Hospital Name" >
                                    <span style="color:red">{{ $errors->has('clinic_name') ? $errors->first('clinic_name') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="clinic_address">Clinic or Hospital Address</label>
                                    <input type="text" class="form-control" id="clinic_address" name="clinic_address" value="{{ old('clinic_address') }}" placeholder="Clinic or Hospital Address" >
                                    <span style="color:red">{{ $errors->has('clinic_address') ? $errors->first('clinic_address') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="maximum_patient">Maximum Patient</label>
                                    <input type="text" class="form-control" id="maximum_patient" name="maximum_patient" value="{{ old('maximum_patient') }}" placeholder="Maximum Patient" >
                                    <span style="color:red">{{ $errors->has('maximum_patient') ? $errors->first('maximum_patient') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="start_time">Start Time</label>
                                    <input type="text" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" placeholder="Start Time" >
                                    <span style="color:red">{{ $errors->has('start_time') ? $errors->first('start_time') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_time">End Time</label>
                                    <input type="text" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" placeholder="End Time" >
                                    <span style="color:red">{{ $errors->has('end_time') ? $errors->first('end_time') : '' }}</span>
                                </div>


                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>

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
                    day_id: {
                        required: true,
                    },
                    clinic_name: {
                        required: true,
                    },
                    clinic_address: {
                        required: true,
                    },
                    maximum_patient: {
                        required: true,
                        number: true
                    },

                    start_time: {
                        required: true,
                    },

                    end_time: {
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
