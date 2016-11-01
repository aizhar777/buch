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
        'App\Events\TradeCreated' => [],
        'App\Events\TradeUpdated' => [],
        'App\Events\TradeChangedCurator' => [],
        'App\Events\TradeChangedStatus' => [],
        'App\Events\TradeAddedProduct' => [],
        'App\Events\TradeReducingOfItems' => [], // Уменьшение числа товаров --
        'App\Events\TradeIncreaseOfItems' => [], // Увеличение числа товаров ++
        'App\Events\TradeIsComplete' => [],
        'App\Events\TradeMovedToArchive' => [],

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
