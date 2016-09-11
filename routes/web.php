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

Route::get('/', ['middleware'=>'debug',function () {
    return view('welcome');
}]);

Route::get('/login',  ['middleware'=>'debug',function () {
    return redirect()->route('signInForm');
}]);

Route::get('/test', function () {
    $first = config('test.balance');
    config(['test.balance' => 999.02]);
    $after = config('test.balance');
    return $first.' | '.$after;
});

Route::get('/home', 'HomeController@index')->middleware('debug');