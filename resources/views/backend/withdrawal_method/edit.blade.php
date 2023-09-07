@extends('layouts.backend.app')

@section('title', 'Edit Withdrawal Method')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" integrity="sha512-X6069m1NoT+wlVHgkxeWv/W7YzlrJeUhobSzk4J09CWxlplhUzJbiJVvS9mX1GGVYf5LA3N9yQW5Tgnu9P4C7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 100%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Edit Withdrawal Method
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.withdrawal-method.view') }}"><i class="fa fa-list-alt"></i> Withdrawal Method List</a></p>
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.withdrawal-method.update', $withdrawal_method->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Method Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $withdrawal_method->name }}" placeholder="Method Name" >
                                    <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="account_type">Account Type <i class="text-danger">(Optional)</i></label>
                                    <input type="text" class="form-control" data-role="tagsinput" id="account_type" name="account_type" value="{{ $withdrawal_method->account_type }}" placeholder="Account Type" >
                                    <span style="color:red">{{ $errors->has('account_type') ? $errors->first('account_type') : '' }}</span>
                                </div>



                                <div class="form-group col-md-12">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>

                            </div>
                        </form>

                    </div> <!-- end card-body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#tagPlaces').tagsinput({
            allowDuplicates: true
        });
    </script>
    <script>
        $(function () {

            $('#quickForm').validate({
                rules: {
                    name: {
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
