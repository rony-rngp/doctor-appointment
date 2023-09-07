@extends('layouts.backend.app')

@section('title', 'Edit CMS')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Edit CMS
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.cms.view') }}"><i class="fa fa-list-alt"></i> CMS List</a></p>
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.cms.update', $cms->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $cms->title }}" placeholder="Title" >
                                <span style="color:red">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="4" name="description" id="description" class="form-control">{{ $cms->description }}</textarea>
                                <span style="color:red">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                            </div>


                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $cms->meta_description }}" placeholder="Meta Description" >
                                <span style="color:red">{{ $errors->has('meta_description') ? $errors->first('meta_description') : '' }}</span>
                            </div>

                            <div class="form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $cms->meta_keyword }}" placeholder="Meta Keyword" >
                                <span style="color:red">{{ $errors->has('meta_keyword') ? $errors->first('meta_keyword') : '' }}</span>
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

    <script type="text/javascript" src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>

    <script>
        $(function () {

            $('#quickForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
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
