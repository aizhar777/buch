<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        'App\Events\UserIsLogged' => [
            'App\Listeners\SendUserLoggedToLogDb',
        ],
        'App\Events\ProductCreated' => [],
        'App\Events\ClientCreated' => [],
        'App\Events\StockCreated' => [],

        // Trade
        'App\Events\TradeCreated' => [
            'App\Listeners\TradeHistoryListenerOfCreated'
        ],
        'App\Events\TradeUpdated' => [
            'App\Listeners\TradeHistoryListenerOfUpdated'
        ],
        'App\Events\TradeChangedCurator' => [
            'App\Listeners\TradeHistoryListenerOfChangedCurator'
        ],
        'App\Events\TradeChangedStatus' => [
            'App\Listeners\TradeHistoryListenerOfChangedStatus'
        ],
        'App\Events\TradeAddedProduct' => [
            'App\Listeners\TradeHistoryListenerOfAddedProduct'
        ],
        'App\Events\TradeReducingOfItems' => [ // Уменьшение числа товаров --
            'App\Listeners\TradeHistoryListenerOnReducingOfItems'

        ],
        'App\Events\TradeIncreaseOfItems' => [ // Увеличение числа товаров ++
            'App\Listeners\TradeHistoryListenerOnIncreaseOfItems',
            'App\Listeners\ProductIncreaseOfItems',
        ],
        'App\Events\TradeIsComplete' => [
            'App\Listeners\TradeHistoryListenerIsComplete'
        ],
        'App\Events\TradeMovedToArchive' => [
            'App\Listeners\TradeHistoryListenerOfMovedToArchive'
        ],

        'App\Events\SubdivisionCreated' => [],
        'App\Events\FieldMapCreated' => [],
        'App\Events\CategoryCreated' => [],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
