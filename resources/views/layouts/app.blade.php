<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="locale" content="{{ App::getLocale() }}"/>
    <title>The Common Home</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/site.css') }}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/slidepanel/slidePanel.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/global/vendor/chartist/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/aspieprogress/asPieProgress.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/jquery-selective/jquery-selective.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">


    <link rel="stylesheet" href="{{ asset('theme/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/examples/css/dashboard/team.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/examples/css/dashboard/v1.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('theme/global/fonts/web-icons/web-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/fonts/font-awesome/font-awesome.css') }}">

    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    @yield('style')
    <script src="{{ asset('theme/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="@yield('body_class') site-menubar-unfold" class="animsition dashboard">
@auth
    @include('layouts.header')
    @include('layouts.menu')
@endauth

<div id="app">
    @yield('content')
</div>

</body>

<script src="{{mix('js/app.js')}}"></script>

<!-- Js Theme -->
<!-- Core  -->
<script src="{{ asset('theme/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
{{--<script src="{{ asset('theme/global/vendor/jquery/jquery.js') }}"></script>--}}
<script src="{{ asset('theme/global/vendor/popper-js/umd/popper.min.js') }}"></script>
<script src="{{ asset('theme/global/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('theme/global/vendor/animsition/animsition.js') }}"></script>
<script src="{{ asset('theme/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('theme/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
<script src="{{ asset('theme/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
<script src="{{ asset('theme/global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('theme/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('theme/global/vendor/intro-js/intro.js') }}"></script>
<script src="{{ asset('theme/global/vendor/screenfull/screenfull.js') }}"></script>
<script src="{{ asset('theme/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
<script src="{{ asset('theme/global/vendor/skycons/skycons.js') }}"></script>

<script src="{{ asset('theme/global/vendor/aspieprogress/jquery-asPieProgress.js') }}"></script>
<script src="{{ asset('theme/global/vendor/matchheight/jquery.matchHeight-min.js') }}"></script>
<script src="{{ asset('theme/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('theme/global/vendor/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('theme/global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js') }}"></script>

<!-- Scripts -->
<script src="{{ asset('theme/global/js/Component.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin.js') }}"></script>
<script src="{{ asset('theme/global/js/Base.js') }}"></script>
<script src="{{ asset('theme/global/js/Config.js') }}"></script>

<script src="{{ asset('theme/assets/js/Section/Menubar.js') }}"></script>
<script src="{{ asset('theme/assets/js/Section/GridMenu.js') }}"></script>
<script src="{{ asset('theme/assets/js/Section/Sidebar.js') }}"></script>
<script src="{{ asset('theme/assets/js/Section/PageAside.js') }}"></script>
<script src="{{ asset('theme/assets/js/Plugin/menu.js') }}"></script>

<!-- Config -->
<script src="{{ asset('theme/global/js/config/colors.js') }}"></script>
<script src="{{ asset('theme/assets/js/config/tour.js') }}"></script>
<script>Config.set('assets', '{{ asset('theme/assets') }}');</script>

<!-- Page -->
<script src="{{ asset('theme/assets/js/Site.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/asscrollable.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/slidepanel.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/matchheight.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('theme/global/js/Plugin/jvectormap.js') }}"></script>

<script src="{{ asset('theme/global/js/Plugin/material.js') }}"></script>

<script>
    (function (document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function () {
            Site.run();
        });
    })(document, window, jQuery);
</script>
@yield('script')

</html>
