<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Common Homes</title>
    <meta charset="UTF-8">
    <meta name="description" content="The common homes">
    <meta name="keywords" content="The common homes, Homes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--favicon-->
    <link rel="icon" type="image/png" href="./favicon.ico"/>

    <script src="{{ asset('theme/assets/js/jquery-3.5.1.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('theme/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/swiper-bundle.css') }}"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/flickity.css') }}" media="screen"/>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}"/>
    <style>
        .btn-right-fixed {
            position: fixed;
            bottom: 80px;
            right: 30px;
            z-index: 11199;
            background: transparent;
        }
        .chat-icon-fixed {
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 11199;
            background: transparent;
        }
    </style>
</head>
<body>
<!--  Header -->
    @include('layouts.header')
<!--  End Header -->

<div id="app">
    @yield('content')
</div>

<!--Fade-->
<div class="fade backdrop"></div>
<!--End Fade-->

<!-- Footer  -->
@include('layouts.footer')

        <!-- End Footer  -->
        <!-- Java script -->
        <script src="{{ asset('theme/assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/parallax.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/flickity.pkgd.min.js') }}"></script>
        <script src="{{ asset('theme/assets/js/main.js') }}"></script>
</body>
</html>
