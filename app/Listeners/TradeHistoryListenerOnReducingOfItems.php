<?php

namespace App\Listeners;

use App\Events\TradeReducingOfItems;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOnReducingOfItems
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TradeReducingOfItems  $event
     * @return void
     */
    public function handle(TradeReducingOfItems $event)
    {
        //
    }
}
