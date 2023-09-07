<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> @yield('title') | {{ $settings->website_name }}</title>

    <link type="image/x-icon" href="{{ url($settings->favicon) }}" rel="icon">

    <meta name="description" content="{{ isset($meta_description) ? $meta_description : $settings->meta_description }}">
    <meta name="keywords" content="{{ isset($meta_keyword) ? $meta_keyword : $settings->meta_keyword }}">
    <meta name="author" content="Rony Islam">

    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/plugins/fontawesome/css/all.min.css">

    <!-- izitoast -->
    <link href="{{ asset('public/css/iziToast.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">

    <style>
        .dropify-wrapper .dropify-message p{
            font-size: initial;
        }

        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{ asset('public/frontend/ajax-loader.gif') }}) center no-repeat #fff;
        }
    </style>

    @stack('css')

</head>
<body>

<div class="main-wrapper">

    <div class="se-pre-con"></div>


    @include('layouts.frontend.partial.header')


    @yield('content')


    @include('layouts.frontend.partial.footer')

</div>


<script src="{{ asset('public/frontend') }}/assets/js/jquery.min.js"></script>

<script src="{{ asset('public/frontend') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/bootstrap.min.js"></script>

<script src="{{ asset('public/frontend') }}/assets/js/slick.js"></script>

<script src="{{ asset('public/frontend') }}/assets/js/script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- dropify -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
    $('.dropify').dropify();
</script>

<!-- izitoast -->
<script src="{{ asset('public/js/iziToast.js') }}"></script>
@include('vendor.lara-izitoast.toast')

<script>
    $('.se-pre-con').hide();
</script>

@stack('js')

</body>

</html>
