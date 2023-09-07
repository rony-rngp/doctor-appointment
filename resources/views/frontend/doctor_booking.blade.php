@extends('layouts.frontend.app')

@section('title', $doctor->name)

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
                            <li class="breadcrumb-item active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Booking</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content" style="min-height: 200px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="{{ route('doctor.profile', $doctor->id) }}" class="booking-doc-img">
                                    <img src="{{ url($doctor->image) }}" alt="User Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{ route('doctor.profile', $doctor->id) }}">{{ $doctor->name }}</a></h4>
                                    <p class="doc-department"><img src="{{ url($doctor->specialist->image) }}" class="img-fluid" alt="Speciality">{{ $doctor->specialist->name }}</p>
                                    <div class="rating">
                                        <?php
                                        if ($doctor->reviews()->avg('ratting') < 1){
                                            for ($i=1; $i<=5;$i++){
                                                echo '<i class="fas fa-star "></i>';
                                            }

                                        }else{
//                                                    for ($x = 1; $x <= $doctor->reviews()->avg('ratting'); $x++) {
//                                                        echo '<i class="fas fa-star filled"></i>';
//                                                    }
                                            $avarege = $doctor->reviews()->avg('ratting');

                                            if ($avarege >= 1 && $avarege< 2){
                                                echo '<i class="fas fa-star filled"></i>';

                                                for ($i=1; $i<=4;$i++){
                                                    echo '<i class="fas fa-star "></i>';
                                                }
                                            }

                                            elseif ($avarege >= 2 && $avarege<3){
                                                for ($i=1; $i<=2;$i++){
                                                    echo '<i class="fas fa-star filled"></i>';
                                                }

                                                for ($i=1; $i<=3;$i++){
                                                    echo '<i class="fas fa-star "></i>';
                                                }
                                            }

                                            elseif ($avarege >= 3 && $avarege<4){
                                                for ($i=1; $i<=3;$i++){
                                                    echo '<i class="fas fa-star filled"></i>';
                                                }

                                                for ($i=1; $i<=2;$i++){
                                                    echo '<i class="fas fa-star "></i>';
                                                }
                                            }

                                            elseif ($avarege >= 4 && $avarege < 5){
                                                for ($i=1; $i<=4;$i++){
                                                    echo '<i class="fas fa-star filled"></i>';
                                                }

                                                for ($i=1; $i<=1;$i++){
                                                    echo '<i class="fas fa-star "></i>';
                                                }
                                            }

                                            elseif ($avarege == 5){
                                                for ($i=1; $i<=5;$i++){
                                                    echo '<i class="fas fa-star filled"></i>';
                                                }

                                            }


                                        }

                                        ?>


                                        <span class="d-inline-block average-rating">({{ $doctor->reviews()->avg('ratting') >= 1 ?  $doctor->reviews()->avg('ratting') : 0 }})</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-money-bill-alt"></i> &nbsp;{{ $doctor->fees }} BDT</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="quickForm" action="{{ route('book') }}" method="post">
                        @csrf
                        <div class="card">

                            <div class="schedule-cont">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="patient_name">Patient Name</label>
                                        <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $patient->name }}" placeholder="Patient Name" >
                                        <span style="color:red">{{ $errors->has('patient_name') ? $errors->first('patient_name') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="patient_phone">Patient Phone</label>
                                        <input type="text" class="form-control" id="patient_phone" name="patient_phone" value="{{ $patient->phone }}" placeholder="Patient Phone" >
                                        <span style="color:red">{{ $errors->has('patient_phone') ? $errors->first('patient_phone') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="patient_gender">Gender</label>
                                        <select name="patient_gender" class="form-control" id="patient_gender">
                                            <option {{ $patient->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ $patient->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('patient_gender') ? $errors->first('patient_gender') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="patient_dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="patient_dob" name="patient_dob" value="{{ $patient->dob }}">
                                        <span style="color:red">{{ $errors->has('patient_dob') ? $errors->first('patient_dob') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="patient_blood_group">Blood Group</label>
                                        <select name="patient_blood_group" class="form-control" id="patient_blood_group">
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



                                    <div class="col-md-12">

                                        <input type="hidden" id="doctor_id" name="doctor_id" value="{{ $doctor->id }}">

                                        <div class="form-group">
                                            <label for="date">Select Your Appointment Date</label>
                                            <input type="text" readonly class="form-control" name="date" id="date" placeholder="Select Your Appointment Date">
                                            <span class="text-danger" id="dateError"></span>
                                            <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                        </div>

                                        <div class="form-group" id="select_schedule_filed" style="display: none">
                                            <label for="schedule">Select Schedule</label>
                                            <select class="form-control" name="schedule_id" id="schedule_id">
                                                <option value="">Select Schedule</option>

                                            </select>
                                            <span class="text-danger" id="scheduleError"></span>
                                            <span class="text-success" id="scheduleSuccess"></span>
                                        </div>

                                        <div class="form-group" >
                                            <label class="control-label"><strong>PAYMENT METHODS : </strong></label>
                                            <hr style="margin-top: 8px;margin-bottom: 8px">
                                            <div>
                                                <input type="radio" name="payment_method" id="Paypal" value="Paypal">&nbsp;<label for="Paypal">Paypal</label>&nbsp;&nbsp;
                                            </div>
                                            <div>
                                                <input type="radio" name="payment_method" id="Sslcommerz" value="Sslcommerz">&nbsp;<label for="Sslcommerz">Sslcommerz</label>&nbsp;&nbsp;
                                            </div>
                                            <div>
                                                <input type="radio" name="payment_method" id="Bkash" value="Bkash">&nbsp;<label for="Bkash">Bkash</label>&nbsp;&nbsp;
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{ Session::forget('appointment') }}
                        {{ Session::forget('amount') }}


                        <div class="submit-section proceed-btn text-right" id="select_button_filed" style="display: none">
                            <button type="submit" class="btn btn-primary submit-btn">Proceed to Pay</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>

        $("#date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            autoHide: true,
        });

        $('#date').on('change', function () {
            var date = $(this).val();
            var doctor_id = $('#doctor_id').val();

            $("#select_button_filed").hide();

            $('.se-pre-con').show();

            $.ajax({
                url : "{{ route('check.schedule') }}",
                type : 'get',
                data : {date:date, doctor_id: doctor_id},

                success:function (response) {
                    if(response.status == true){

                        $('#select_schedule_filed').show();
                        $("#dateError").text('');
                        $("#scheduleSuccess").text('');
                        $("#scheduleError").text('');

                        var html = '<option value="">Select Schedule</option>';
                        $.each(response.schedules, function (key, v) {
                            html +='<option value="'+v.id+'">'+v.start_time+' - '+v.end_time+' ( '+v.clinic_name+ ' - '+ v.clinic_address+' ) '+'</option>';
                        });
                        $('#schedule_id').html(html);

                    }else{
                        $('#select_schedule_filed').hide();
                        $('#schedule_id').html('');
                        $('#dateError').text(response.message);
                    }

                    $('.se-pre-con').hide();
                }

            });
        });

        $('#schedule_id').on('change', function () {
            var schedule_id = $(this).val();
            var date = $("#date").val();
            var doctor_id = $("#doctor_id").val();

            $('.se-pre-con').show();

            $.ajax({
                url : "{{ route('check.available.schedule') }}",
                type : 'get',
                data : {schedule_id: schedule_id, date: date, doctor_id:doctor_id},

                success:function (response) {
                    if(response.status == true){
                        $("#select_button_filed").show();
                        $('#scheduleError').text('');
                        $('#scheduleSuccess').text(response.message);
                    }else{
                        $("#select_button_filed").hide();
                        $('#scheduleError').text(response.message);
                        $('#scheduleSuccess').text('');
                    }

                    $('.se-pre-con').hide();
                }

            });

        });

    </script>


    <script>
        $(function () {

            $('#quickForm').validate({
                rules: {
                    patient_name: {
                        required: true,

                    },
                    patient_phone: {
                        required: true,
                    },
                    patient_gender: {
                        required: true,
                    },
                    patient_dob: {
                        required: true,
                    },
                    patient_blood_group: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    schedule_id: {
                        required: true,
                    },
                    payment_method: {
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
