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

            @include('block.flash_messages')

            <section class="login_content">
                <form method="POST" action="{{ url('/auth/signup') }}">
                    {{ csrf_field() }}
                    <h1>Register</h1>

                    <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name" autofocus required>
                    </div>

                    <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="E-mail address" required>
                    </div>

                    <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
                    </div>

                    <div class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Password confirmation" required>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-default submit">Register</button>
                    </div>

                    <div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
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
