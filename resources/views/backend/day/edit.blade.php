@extends('layouts.backend.app')

@section('title', 'Edit Day')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Add Day
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.day.view') }}"><i class="fa fa-list-alt"></i> Day List</a></p>
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.day.update', $day->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $day->name }}" placeholder="Specialist" >
                                <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>

                            <div class="form-group col-md-12">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
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
