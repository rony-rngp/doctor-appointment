@extends('layouts.backend.app')

@section('title', 'Settings')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Settings
                    </div>

                    <div class="card-body">
                        <form id="quickForm" action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="website_name">Website Name</label>
                                    <input type="text" class="form-control" id="website_name" name="website_name" value="{{ $settings->website_name }}" placeholder="Website Name" >
                                    <span style="color:red">{{ $errors->has('website_name') ? $errors->first('website_name') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="website_email">Website Email</label>
                                    <input type="email" class="form-control" id="website_email" name="website_email" value="{{ $settings->website_email }}" placeholder="Website Email" >
                                    <span style="color:red">{{ $errors->has('website_email') ? $errors->first('website_email') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="website_phone">Website Phone</label>
                                    <input type="text" class="form-control" id="website_phone" name="website_phone" value="{{ $settings->website_phone }}" placeholder="Website Phone" >
                                    <span style="color:red">{{ $errors->has('website_phone') ? $errors->first('website_phone') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="website_address">Website Address</label>
                                    <input type="text" class="form-control" id="website_address" name="website_address" value="{{ $settings->website_address }}" placeholder="Website Address" >
                                    <span style="color:red">{{ $errors->has('website_address') ? $errors->first('website_address') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $settings->meta_description }}" placeholder="Meta Description" >
                                    <span style="color:red">{{ $errors->has('meta_description') ? $errors->first('meta_description') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $settings->meta_keyword }}" placeholder="Meta Keyword" >
                                    <span style="color:red">{{ $errors->has('meta_keyword') ? $errors->first('meta_keyword') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settings->facebook }}" placeholder="Facebook" >
                                    <span style="color:red">{{ $errors->has('facebook') ? $errors->first('facebook') : '' }}</span>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $settings->twitter }}" placeholder="Twitter" >
                                    <span style="color:red">{{ $errors->has('twitter') ? $errors->first('twitter') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $settings->linkedin }}" placeholder="Linkedin" >
                                    <span style="color:red">{{ $errors->has('linkedin') ? $errors->first('linkedin') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settings->instagram }}" placeholder="Instagram" >
                                    <span style="color:red">{{ $errors->has('instagram') ? $errors->first('instagram') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="favicon">Favicon</label>
                                    <input type="file" name="favicon" class="form-control dropify" data-default-file="{{ file_exists($settings->favicon) ? url($settings->favicon) : '' }}" data-max-file-size="2M" id="favicon" accept="image/*">
                                    <span style="color:red">{{ $errors->has('favicon') ? $errors->first('favicon') : '' }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="header_logo">Header Logo</label>
                                    <input type="file" name="header_logo" class="form-control dropify" data-max-file-size="2M" data-default-file="{{ file_exists($settings->header_logo) ? url($settings->header_logo) : '' }}" id="header_logo" accept="image/*">
                                    <span style="color:red">{{ $errors->has('header_logo') ? $errors->first('header_logo') : '' }}</span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="footer_logo">Footer Logo</label>
                                    <input type="file" name="footer_logo" class="form-control dropify" data-default-file="{{ file_exists($settings->footer_logo) ? url($settings->footer_logo) : '' }}" data-max-file-size="2M" id="footer_logo" accept="image/*">
                                    <span style="color:red">{{ $errors->has('footer_logo') ? $errors->first('footer_logo') : '' }}</span>
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
                    website_name: {
                        required: true,
                    },
                    website_email: {
                        required: true,
                    },
                    website_phone: {
                        required: true,
                    },
                    website_address: {
                        required: true,
                    },
                    facebook: {
                        required: true,
                    },
                    twitter: {
                        required: true,
                    },
                    linkedin: {
                        required: true,
                    },
                    instagram: {
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
