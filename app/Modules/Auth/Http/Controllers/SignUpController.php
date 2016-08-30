<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;

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

    /**
     * Create a new user instance after a valid registration. And add role Visitor.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $role = \App\Role::where('slug','visitor')->first();
        $user->assignRole($role->id);
        return $user;
    }

}
