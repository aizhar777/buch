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
    //$field = \App\Library\BFields::getInstance();
/*    $paramModel = $field->createMapField([
        'name' => 'Gender',
        'slug' => 'gender',
        'default_value' => 'Male|Female',
        'description' => 'User Gender',
        'accessory_type' => \App\User::TYPE,
        'is_many_values' => 1
    ]);*/
    $plugin = App\Library\BFields::getInstance();
    dd(
        $plugin->all(1,'App\User')
    );
});

Route::get('/home', 'HomeController@index')->middleware('debug');