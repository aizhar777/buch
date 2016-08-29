<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;

class ForgotController extends ForgotPasswordController
{

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth::passwords.email');
    }
}
