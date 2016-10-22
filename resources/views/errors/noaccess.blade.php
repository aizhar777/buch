@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="error_no_access_wrapper">
            <div class="code"><i class="fa fa-warning"></i> {{$code or '403'}}</div>
            <div class="message">{{$message or 'You are not have permission to view this page!'}}</div>
        </div>
    </div>
    <!-- /page content -->
@endsection
