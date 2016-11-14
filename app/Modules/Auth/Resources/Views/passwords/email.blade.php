@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#">{!! config('app.html_name') !!}</a>
        </div>


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Reset Password</p>

            <form action="{{ url('/auth/forgot/email') }}" method="post">

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block separator">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                    </div>
                    <!-- /.col -->

                </div>
            </form>
            <br>
            <a href="{{ route('signInForm') }}" class="text-center">Already a member?</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
