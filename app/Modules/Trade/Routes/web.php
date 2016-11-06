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

Route::group(['prefix' => 'trade', 'middleware' => ['debug', 'auth']], function() {

    Route::get('/', 'IndexController@index')->name('trade');
    Route::get('/create', 'IndexController@create')->name('trade.create');
    Route::get('/show/{id}', 'IndexController@show')->where(['id' => '[0-9]+'])->name('trade.show');
    Route::get('/edit/{id}', 'IndexController@edit')->where(['id' => '[0-9]+'])->name('trade.edit');

    Route::post('/store', 'IndexController@store')->name('trade.store');
    Route::put('/update/{id}', 'IndexController@update')->where(['id' => '[0-9]+'])->name('trade.update');
    Route::delete('/destroy/{id}', 'IndexController@destroy')->where(['id' => '[0-9]+'])->name('trade.destroy');

    // AJAX

    Route::get('/{id}/get/products', 'AjaxController@getProducts')->where(['id' => '[0-9]+'])->name('trade.get.products');
    Route::put('/add/products', 'AjaxController@addProducts')->where(['id' => '[0-9]+'])->name('trade.add.products');
});
