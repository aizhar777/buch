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
}])->name('public');

Route::get('/login',  ['middleware'=>'debug',function () {
    return redirect()->route('signInForm');
}]);

Route::get('/home', function (){
    return redirect(route('dashboard'), 301);
});

Route::get('/dashboard', 'HomeController@index')
    ->middleware(['debug','auth'])
    ->name('dashboard');


#---- TEST -----#
Route::get('/test', function () {
    $product = \App\Product::first();

    dd($product);
    dd($product->subdivision());
    //$electronics = \App\Category::where('cat_type', '=', 'App\Product\Subdivision')->first();
    //$electronics->makeTree($children); // => true
});