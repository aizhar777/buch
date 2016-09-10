<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'auth','middleware'=>'debug'], function() {
    Route::get('/', 'SignInController@showLoginForm');

    Route::get('/signin',  'SignInController@showLoginForm')->name('signInForm');
    Route::post('/signin',  'SignInController@login');

    Route::get('/signup',  'SignUpController@showRegistrationForm')->name('signUpForm');
    Route::post('/signup',  'SignUpController@register');

    Route::post('/signout',  'SignInController@logout');

    Route::get('/forgot',  'ForgotController@showLinkRequestForm');
    Route::get('/forgot/reset',  'ForgotController@showLinkRequestForm')->name('passwordForgotForm');
    Route::get('/forgot/{token}',  'ResetController@showResetForm')->name('emailForgotForm');
    Route::post('/forgot/email',  'ForgotController@sendResetLinkEmail');
    Route::post('/forgot/reset',  'ResetController@reset');
});
