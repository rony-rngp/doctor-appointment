@extends('layouts.doctor.app')

@section('title', 'Appointment List')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Appointment Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>#{{ $appointment->id }}</td>
                            </tr>
                            <tr>
                                <th>Appointment Date</th>
                                <td>{{ $appointment->appointment_date.' On '.$appointment->day->name }}</td>
                            </tr>
                            <tr>
                                <th>Clinic Name</th>
                                <td>{{ $appointment->clinic_name }}</td>
                            </tr>
                            <tr>
                                <th>Clinic Address</th>
                                <td>{{ $appointment->clinic_address }}</td>
                            </tr>
                            <tr>
                                <th>Schedule</th>
                                <td>{{ $appointment->schedule }}</td>
                            </tr>
                            <tr>
                                <th>Fee</th>
                                <td>{{ $appointment->fees }} BDT</td>
                            </tr>
                            <tr>
                                <th>Patient Name</th>
                                <td>{{ $appointment->patient_name }}</td>
                            </tr>
                            <tr>
                                <th>Patient Phone</th>
                                <td>{{ $appointment->patient_phone }}</td>
                            </tr>
                            <tr>
                                <th>Patient Gender</th>
                                <td>{{ $appointment->patient_gender }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birthday</th>
                                <td>{{ $appointment->patient_dob }}</td>
                            </tr>
                            <tr>
                                <th>Blood Group</th>
                                <td>{{ $appointment->patient_blood_group }}</td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td>{{ $appointment->payment_method }}</td>
                            </tr>
                            <tr>
                                <th>Payment Status</th>
                                <td>{{ $appointment->payment_status }}</td>
                            </tr>
                            <tr>
                                <th>Created On</th>
                                <td>{{ $appointment->created_at }}</td>
                            </tr>


                        </table>
                    </div> <!-- end card body-->
                </div> <!-- end card --><!-- end card -->
            </div><!-- end col-->


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Status
                    </div>
                    <div class="card-body">
                        <form id="quickForm" action="{{ route('doctor.appointment.update', $appointment->id) }}" method="post">
                            @csrf

                            <input type="hidden" id="appointment_id" name="appointment_id" value="{{ $appointment->id }}">

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control status" {{ $appointment->status == 'Confirmed' ? 'disabled' : '' }}>
                                    <option {{ $appointment->status == 'Pending' ? 'selected' : '' }} value="Pending">Pending</option>
                                    <option {{ $appointment->status == 'Confirmed' ? 'selected' : '' }} value="Confirmed">Confirmed</option>
                                </select>
                            </div>

                            <div class="form-group" id="otp_form" style="display: none">
                                <label for="otp">Otp Code</label>
                                <input type="text" name="otp" id="otp" class="form-control">
                            </div>

                            <button class="btn btn-primary"  {{ $appointment->status == 'Confirmed' ? 'disabled' : '' }} type="submit">Update</button>
                        </form>
                     </div>
                </div> <!-- end card body-->
            </div>
        </div>
    </div> <!-- container -->




@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('.status').on('change', function () {
                var status = $(this).val();
                var appointment_id = $('#appointment_id').val();

                if (status == 'Confirmed'){

                    $.ajax({
                        url : "{{ route('doctor.appointment.check.otp') }}",
                        type : 'get',
                        data : {status:status, appointment_id:appointment_id},

                        success:function (response) {
                            if(response.status == true){
                                iziToast.success({
                                    title: 'Success',
                                    position: 'topRight',
                                    message: response.message
                                });

                                $('#otp_form').show();

                            }else{
                                iziToast.error({
                                    title: 'Error',
                                    position: 'topRight',
                                    message: response.message
                                });
                                $('#otp_form').hide();
                                $('#otp').val('');
                            }
                        }

                    });
                }else{
                    $('#otp_form').hide();
                    $('#otp').val('');
                }
            });
        });
    </script>

    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    status: {
                        required: true,
                    },

                    otp: {
                        required: true,
                        number: true
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

    <script>

        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.onkeydown = function(e) {

            if(event.keyCode == 123) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
            if (event.keyCode == 123) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey) {
                return false;
            }
            if (event.ctrlKey && event.keyCode == 85) {
                return false;
            }
        }
    </script>

@endpush
