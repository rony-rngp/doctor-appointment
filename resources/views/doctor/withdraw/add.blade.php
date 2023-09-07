@extends('layouts.doctor.app')

@section('title', 'Withdraw')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Withdraw
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('doctor.withdraw.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" class="form-control" id="payment_method">
                                        <option value="">Payment Method</option>
                                        @foreach($withdrawal_methods as $withdrawal_method)
                                            <option value="{{ $withdrawal_method->name }}">{{ $withdrawal_method->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->has('payment_method') ? $errors->first('payment_method') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6" id="account_type_filed" style="display: none">
                                    <label for="account_type">Account Type</label>
                                    <select name="account_type" class="form-control" id="account_type">

                                    </select>
                                    <span style="color:red">{{ $errors->has('account_type') ? $errors->first('account_type') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="amount">Amount ( BDT )</label>
                                    <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Amount" >
                                    <span style="color:red">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="account_number">Account Number (<i class="text-danger"> Put your number carefully </i>)</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}" placeholder="Account Number" >
                                    <span style="color:red">{{ $errors->has('account_number') ? $errors->first('account_number') : '' }}</span>
                                </div>

                            </div>

                            <input class="btn btn-primary" id="myButton" type="submit" value="Submit">

                        </form>

                    </div> <!-- end card-body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->

@endsection

@push('js')

    <script>

        $("#payment_method").on('change', function () {
            var name = $(this).val();
            if(name != ''){
                $.ajax({
                    url : "{{ route('doctor.withdraw.check_account_type') }}",
                    type : 'get',
                    data : {name: name},

                    success: function (response) {
                        if (response.status == true){
                            $("#account_type").val('');
                            var html = '<option value="">Account Type</option>';
                            $.each(response.account_type, function (key, v) {
                                html +='<option value="'+v+'">'+v+'</option>';
                            });
                            $('#account_type').html(html);
                            $("#account_type_filed").show();
                        }else{
                            $("#account_type_filed").hide();
                            $("#account_type").val('');
                        }
                    }

                });
            }else{
                $("#account_type_filed").hide();
                $("#account_type").val('');
            }


        });
    </script>

    <script>
        $(function () {

            $('#quickForm').validate({

                rules: {
                    payment_method: {
                        required: true,
                    },
                    account_type: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        minlength: 2,
                        number: true,
                    },
                    account_number: {
                        required: true,
                        number: true,
                    },
                },
                messages: {

                },
                submitHandler: function(form) { // <- pass 'form' argument in
                    form.myButton.disabled = true;
                    form.myButton.value = "Please wait...";
                    return true;
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
