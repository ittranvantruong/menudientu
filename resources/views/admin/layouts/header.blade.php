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
    <meta name="currency" content="{{ config('mevivu.currency') }}">

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
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<style>
    .close-jq-toast-single-custom{
        position: unset !important;
    }
</style>
<script>
    	var x = new Audio('{{ asset(config("mevivu.audio")) }}');
        function playAudio() {
            // Show loading animation.
            var playPromise = x.play();

            if (playPromise !== undefined) {
            playPromise.then(_ => {
                    x.play();
                })
                .catch(error => {
                });

            }
        }
        function pausedAudio() {
            // Show loading animation.
            var playPromise = x.pause();

            if (playPromise !== undefined) {
            playPromise.then(_ => {
                x.pause();
            })
            .catch(error => {
            });
            }
        }
    
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
      cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
    });

    var channel = pusher.subscribe('userOrderChannel');
    channel.bind('userOrderEvent', function(data) {
        var data = data.msg;
        $.toast({
            heading: data.msg,
            text: 'Truy cập <a href="'+data.link+'">Đơn hàng ngay</a>.',
            position: 'bottom-right',
            hideAfter: false,
            icon: 'warning'
        });
    });

    var channel2 = pusher.subscribe('callEmployeeChannel');
    channel2.bind('callEmployeeEvent', function(data) {
        var data = data.msg;
        $.toast({
            heading: data.msg,
            text: data.text,
            position: 'bottom-left',
            hideAfter: false,
            icon: 'error'
        });
        playAudio();
    });

  </script>
<body id="page-top">