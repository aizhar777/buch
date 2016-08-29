<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;

class SignInController extends LoginController
{
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth::login');
    }
}
