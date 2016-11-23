<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Events\UserIsLogged;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

class SignInController extends LoginController
{
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth::login');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        \Session::remove('current.user');
        $photo = $user->photos()->first();
        $roles = $user->roles();

        event(new UserIsLogged($user));
        \Session::put('current.user',$user);
        \Session::put('current.perms',$user->getPermissions());
        \Session::put('current.roles',$roles->get());
        if(!empty($photo)) \Session::put('current.image',$photo->src);
    }
}
