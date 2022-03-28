<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="url-home" content="{{ url('/') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('mevivu.images.shortcut-icon')) }}" />
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('public/lib/Parsley.js-2.9.2/style.css') }}" rel="stylesheet">
    @stack('css')

    <script src="{{ asset('public/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('public/lib/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('public/lib/Parsley.js-2.9.2/parsley.min.js') }}"></script>

</head>

<body id="page-top">