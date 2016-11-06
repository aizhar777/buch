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
    Route::get('/list', 'IndexController@usersList')->name('user');

    # Profile or Show user
    Route::get('/{id?}', 'IndexController@userProfile')->where(['id' => '[0-9]+'])->name('user.profile');

    # Create
    Route::get('/create', 'IndexController@userCreate')->name('user.create');
    Route::post('/create', 'DataController@userCreate')->name('user.store');

    # Edit
    Route::get('/edit/{id}', 'IndexController@userEdit')->where(['id' => '[0-9]+'])->name('user.edit');
    Route::put('/edit/{id}', 'DataController@userEdit')->where(['id' => '[0-9]+'])->name('user.edit.post');
    Route::put('/edit/{id}/set/image/{image}', 'DataController@userUpdateImage')->where(['id' => '[0-9]+','image' => '[0-9]+'])->name('user.update.image');

    # Delete
    Route::delete('/delete/{id}', 'DataController@userDelete')->where(['id' => '[0-9]+']);

    // Roles
    Route::get('/roles', 'IndexController@rolesAction')->name('user.roles');
    Route::get('/roles/create', 'IndexController@rolesCreateAction')->name('user.roles.create');
    Route::get('/roles/{id}', 'IndexController@rolesShowAction')->where(['id' => '[0-9]+'])->name('user.roles.show');
    Route::get('/roles/{slug}', 'IndexController@rolesShowBySlugAction')->where(['slug' => '[a-zA-Z_.-]+'])->name('user.roles.show_slug');
    Route::get('/roles/edit/{id}', 'IndexController@rolesEditAction')->where(['slug' => '[a-zA-Z]+'])->name('user.roles.edit');

    Route::post('/roles/store', 'DataController@rolesCreate')->name('user.roles.store');
    Route::put('/roles/update/{id}', 'DataController@rolesUpdate')->where(['id' => '[0-9]+'])->name('user.roles.update');
    Route::put('/roles/update/{id}/permissions', 'DataController@rolesUpdatePermissions')->where(['id' => '[0-9]+'])->name('user.roles.update.perms');
    Route::delete('/roles/delete/{id}', 'DataController@rolesDelete')->where(['id' => '[0-9]+'])->name('user.roles.delete');

    // Permissions
    Route::get('/permissions', 'IndexController@permissionAction')->name('user.perms');
    Route::get('/permissions/{id}', 'IndexController@permissionShowAction')->where(['id' => '[0-9]+'])->name('user.perms.show');
    Route::get('/permissions/create', 'IndexController@permissionCreateAction')->name('user.perms.create');
    Route::get('/permissions/edit/{id}', 'IndexController@rpermissionEditAction')->where(['id' => '[0-9]+'])->name('user.perms.edit');

    Route::post('/permissions/store', 'DataController@permissionCreate')->name('user.perms.store');
    Route::put('/permissions/update/{id}', 'DataController@permissionUpdate')->where(['id' => '[0-9]+'])->name('user.perms.update');
    Route::delete('/permissions/delete/{id}', 'DataController@permissionDelete')->where(['id' => '[0-9]+'])->name('user.perms.delete');


});
