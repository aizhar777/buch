<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect()->route('signInForm');
});

Route::get('/test', function () {
    $role = \App\Role::where('slug','admin')->first();
   dd($role);
});

Route::get('/home', 'HomeController@index');