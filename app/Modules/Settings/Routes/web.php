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

Route::group(['prefix' => 'settings', 'middleware' => ['debug', 'auth']], function() {

    Route::get('/', 'IndexController@view')->name('settings');

    //Route::get('/create', 'IndexController@create')->name('settings.create');

    //Route::post('/create', 'DataController@create')->name('settings.data.create');

    Route::put('/edit/{slug}', 'DataController@edit')
        ->where(['slug' => '[a-zA-Z_-]+'])
        ->name('settings.edit');

    Route::delete('/delete/{slug}', 'DataController@delete')->where(['slug' => '[0-9]+'])->name('settings.delete');

});
