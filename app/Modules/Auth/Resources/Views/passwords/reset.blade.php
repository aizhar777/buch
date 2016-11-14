@extends('layouts.app')

@section('body-style')
    hold-transition register-page
@stop

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="#">{!! config('app.html_name') !!}</a>
        </div>

        @include('block.flash_messages')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">Reset Password</p>

            <form action="{{ url('/auth/forgot/reset') }}" method="post">

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}"  placeholder="E-mail address" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block separator">
                            <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">

                    <div class="col-xs-6">
                        <input type="hidden" name="token" value="{{$token}}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                    </div>
                    <!-- /.col -->

                </div>
            </form>
            <br>
            <a href="{{ route('signInForm') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
@endsection
