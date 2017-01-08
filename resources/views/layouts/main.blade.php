<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'Home -') {{config('app.name')}}</title>
    <meta name="theme-color" content="#468996">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap -->
    <link href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=cyrillic" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('assets/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/css/site.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/skins/skin-black-light.css')}}">

    <link rel="stylesheet" href="{{url('assets/plugins/pnotify/pnotify.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/iCheck/flat/_all.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/select2/select2.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/jQuery.filer-1.3.0/css/jquery.filer.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Theme Style -->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
    <style>
        {!! $style or '' !!}
    </style>
</head>

<body class="@section('body-style') sidebar-mini skin-black-light @show">

<div class="wrapper">
    @include('block.top_menu_bar')

    @include('block.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('block.footer')
</div>

<!-- jQuery -->
<script src="{{url('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/application.js')}}"></script>

<!-- DataTables -->
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('assets/plugins/slimScroll/jquery.slimScroll.js')}}"></script>
<script src="{{url('assets/plugins/select2/select2.js')}}"></script>
<script src="{{url('assets/plugins/iCheck/icheck.js')}}"></script>
<script src="{{url('assets/plugins/pnotify/pnotify.min.js')}}"></script>
<script src="{{url('assets/plugins/jQuery.filer-1.3.0/js/jquery.filer.min.js')}}"></script>
<script src="{{url('assets/plugins/masonry/masonry.min.js')}}"></script>
<script src="{{url('assets/js/dev.js')}}"></script>
@yield('scripts')
</body>
</html>
