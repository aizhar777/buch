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

Route::get('/', config('app.home_route'))->middleware(['debug'])->name('public');

Route::get('/dashboard', 'HomeController@dashboard')
    ->middleware(['debug','auth'])
    ->name('dashboard');


#---- TEST -----#
Route::get('/test', 'TestResourceController@test');


Route::get('/login', function () {
    return redirect()->route('signInForm');
});