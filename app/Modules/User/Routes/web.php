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

Route::group(['prefix' => 'user','middleware'=> ['debug','auth']], function() {

    # List
    Route::get('/list', 'IndexController@usersList');

    # Profile or Show user
    Route::get('/{id?}', 'IndexController@userProfile')
        ->where([
            'id' => '[0-9]+'
        ]);

    # Create
    Route::get('/create', 'IndexController@userCreate');
    Route::post('/create', 'DataController@userCreate');

    # Edit
    Route::put('/edit/{id}', 'DataController@userEdit')
        ->where([
            'id' => '[0-9]+'
        ]);
    Route::get('/edit/{id}', 'IndexController@userEdit')
        ->where([
            'id' => '[0-9]+'
        ]);

    # Delete
    Route::delete('/delete/{id}', 'DataController@userDelete')
        ->where([
            'id' => '[0-9]+'
        ]);

});
