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

Route::group(['prefix' => 'fields', 'middleware' => ['debug', 'auth']], function () {

    Route::get('/', 'IndexController@show')
        ->name('field.list');

    Route::get('/add', 'IndexController@add')
        ->name('fields.add');

    Route::get('/edit/{id}', 'IndexController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('fields.edit');

    Route::post('/edit/{id}', 'DataController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('fields.data.edit');

    Route::delete('/delete/{id}', 'DataController@delete')
        ->where(['id' => '[0-9]+'])
        ->name('fields.delete');

    Route::post('/create', 'DataController@create')
        ->name('fields.create');

});
