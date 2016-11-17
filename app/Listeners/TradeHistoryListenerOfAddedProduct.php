<?php

namespace App\Listeners;

use App\Events\TradeAddedProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOfAddedProduct
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
     * @param  TradeAddedProduct  $event
     * @return void
     */
    public function handle(TradeAddedProduct $event)
    {
        //
    }
}
