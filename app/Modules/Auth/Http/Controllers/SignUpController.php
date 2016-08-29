<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;

class SignUpController extends RegisterController
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth::register');
    }

}
