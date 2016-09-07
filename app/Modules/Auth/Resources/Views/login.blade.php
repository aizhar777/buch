@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #ffffff;
            width: 99%;
        }
    </style>

    <div class="login">

        <div class="login_wrapper">

            <section class="login_content">
                <form method="POST" action="{{ url('/auth/signin') }}">
                    {{ csrf_field() }}
                    <h1>Login Form</h1>
                    <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               autofocus>
                    </div>
                    <div>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" checked> Remember Me
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-default submit">Log in</button>
                        <a class="reset_pass" href="{{ route('passwordForgotForm') }}">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>
                    <div>
                        @if ($errors->has('password'))
                            <span class="help-block separator">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block separator">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="{{ route('signUpForm') }}" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> {{config('app.name')}}</h1>
                            <p>©2016 All Rights Reserved. {{config('app.name')}} Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div class="clearfix"></div>
    </div>
@endsection
