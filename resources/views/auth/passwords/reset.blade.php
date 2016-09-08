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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <h1>Reset Password</h1>

                    <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus>
                    </div>

                    <div>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary submit"> Reset Password</button>
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

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block separator">
                                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="separator">
                        <p class="change_link">Already a member?
                            <a href="{{ route('signInForm') }}" class="to_register"> Sign in </a>
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
