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

Route::group(['prefix' => 'products', 'middleware' => ['debug', 'auth']], function() {

    Route::get('/{id?}', 'IndexController@view')
        ->where(['id' => '[0-9]+'])
        ->name('products');


    Route::get('/create', 'IndexController@create')
        ->name('products.create');

    Route::post('/create', 'DataController@create')
        ->name('products.data.create');


    Route::get('/edit/{id}', 'IndexController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('products.edit');

    Route::put('/edit/{id}', 'DataController@edit')
        ->where(['id' => '[0-9]+'])
        ->name('products.data.edit');


    Route::delete('/delete/{id}', 'DataController@delete')
        ->where(['id' => '[0-9]+'])
        ->name('products.delete');

    Route::get('/get/form/{id?}', 'DataController@getProductsForm')->where(['id' => '[0-9]+'])->name('products.get.form');
});
