@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#">{!! config('app.html_name') !!}</a>
        </div>

        @include('block.flash_messages')

        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ url('/auth/signin') }}" method="post">

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block separator">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block separator">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="row">

                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" checked> Remember Me
                            </label>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-xs-4">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->

                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->

            <a href="{{ route('passwordForgotForm') }}">I forgot my password</a><br>
            <a href="{{ route('signUpForm') }}" class="text-center">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
