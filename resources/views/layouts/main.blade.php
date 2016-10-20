<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Bootstrap -->
    <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{url('vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{url('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{url('vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{url('vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{url('vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('css/custom.css')}}" rel="stylesheet">
    <style>
        body{
            width: 99%;
        }
        {!! $style or '' !!}
    </style>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">

        @include('block.sidebar')

        @include('block.top_menu_bar')

        @yield('content')

        @include('block.footer')

    </div>
</div>

<!-- jQuery -->
<script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('vendors/fastclick/lib/fastclick.js')}}"></script>

<script src="{{url('vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- NProgress -->
<script src="{{url('vendors/nprogress/nprogress.js')}}"></script>
<!-- PNotify -->
<script src="{{url('vendors/pnotify/dist/pnotify.js')}}"></script>
<script src="{{url('vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
<script src="{{url('vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{url('js/custom.min.js')}}"></script>
<script src="{{url('js/dev.js')}}"></script>
<script src="{{url('js/application.js')}}"></script>
</body>
</html>
