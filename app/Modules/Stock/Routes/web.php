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

Route::group(['prefix' => 'stock', 'middleware' => ['debug', 'auth']], function() {

    Route::get('/', 'IndexController@index')->name('stock');
    Route::get('/create', 'IndexController@create')->name('stock.create');
    Route::get('/show/{id}', 'IndexController@show')->where(['id' => '[0-9]+'])->name('stock.show');
    Route::get('/edit/{id}', 'IndexController@edit')->where(['id' => '[0-9]+'])->name('stock.edit');

    Route::post('/store', 'IndexController@store')->name('stock.store');
    Route::put('/update/{id}', 'IndexController@update')->where(['id' => '[0-9]+'])->name('stock.update');
    Route::delete('/destroy/{id}', 'IndexController@destroy')->where(['id' => '[0-9]+'])->name('stock.destroy');
});
