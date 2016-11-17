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

Route::group(['prefix' => 'reports'], function() {
    Route::get('/', 'ReportController@index')->name('reports');
    Route::get('/create', 'ReportController@create')->name('reports.create');
    Route::post('/store', 'ReportController@store')->name('reports.store');
    Route::get('/show/{id}', 'ReportController@show')->where(['id' => '[0-9]+'])->name('reports.show');
    Route::get('/edit/{id}', 'ReportController@edit')->where(['id' => '[0-9]+'])->name('reports.edit');
    Route::put('/update/{id}', 'ReportController@update')->where(['id' => '[0-9]+'])->name('reports.update');
    Route::delete('/destroy/{id}', 'ReportController@destroy')->where(['id' => '[0-9]+'])->name('reports.destroy');
});
