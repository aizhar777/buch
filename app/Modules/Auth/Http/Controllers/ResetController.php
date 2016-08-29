<?php

namespace App\Modules\Auth\Http\Controllers;


use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;

class ResetController extends ResetPasswordController
{
    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth::passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
