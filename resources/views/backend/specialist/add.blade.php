@extends('layouts.backend.app')

@section('title', 'Add Specialist')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Add Specialist
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.specialist.view') }}"><i class="fa fa-list-alt"></i> Specialist List</a></p>
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.specialist.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Specialist Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Specialist" >
                                <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control dropify" data-max-file-size="5M" id="image" accept="image/*">
                                <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
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
                    name: {
                        required: true,
                    },
                    image: {
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
