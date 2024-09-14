<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('assets/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Express - @yield('title')</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <!-- END: CSS Assets-->
    <!-- BEGIN: Font Assets-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/lineseedTH/font.css') }}">
    <!-- BEGIN: Font Assets-->
    {{-- LIVEWIRE --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        .zoom-80 {
            zoom: 0.8;

        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @livewireStyles
</head>
<!-- END: Head -->

<body class="py-5">
    <!-- BEGIN: Mobile Menu -->
    {{-- @include('front-end.layouts.mobile-menu') --}}
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        @include('front-end.layouts.side-menu')
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            @include('front-end.layouts.top-bar')
            <!-- END: Top Bar -->
            <!-- BEGIN: Alert Bar -->
            @include('front-end.layouts.alert-top')
            <!-- END: Alert Bar -->
            <div class="  mr-2 mb-2 mt-5 mb-5">




                @yield('content')
            </div>
            <!-- END: Content -->
        </div>

        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('/assets/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

        <livewire:scripts />

        <script src="{{ asset('assets/js/sweetalert.all.min.js') }}"></script>

        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
        <x-livewire-alert::flash />
        @stack('scripts')
        <!-- END: JS Assets-->
</body>

</html>
