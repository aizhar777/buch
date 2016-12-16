@extends('layouts.app')

@section('title')
    Register
@stop

@section('body-style')
hold-transition register-page
@stop

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="#">{!! config('app.html_name') !!}</a>
        </div>

        @include('block.flash_messages')

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="{{ url('/auth/signup') }}" method="post">

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name" autofocus required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('surname') ? 'has-error' : '' }}">
                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}"  placeholder="Surname" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('surname'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('patronymic') ? 'has-error' : '' }}">
                    <input id="patronymic" type="text" class="form-control" name="patronymic" value="{{ old('patronymic') }}"  placeholder="Patronymic" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('patronymic'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('patronymic') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="E-mail address" required>
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
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Password confirmation" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">

                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="col-xs-4">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->

                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                    Google+</a>
            </div>

            <a href="{{ route('signInForm') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
@endsection
