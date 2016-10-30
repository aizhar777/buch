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

/**
 * TYPE:
 *  check - Товарный чек
 *  invoice - Счет фактура
 *  certificate - Акт Выполненных Работ
 *  order - Прих Кассовый Ордер
 *
 * FORMAT:
 *  landscape - Альбомная ориентация (landscape orientation)
 *  portrait - Книжная ориентация (portrait orientation)
 */
Route::group(['prefix' => 'printer'], function() {
    Route::get('/trade/{id}/{type}/{format}/{output?}', 'IndexController@printTrade')
    ->where([
        'id' => '[0-9]+',
        'type' => '(check|invoice|certificate|order)',
        'format' => '(landscape|portrait)',
        'output' => '(html|pdf)',
    ])->name('printer.trade');
});
