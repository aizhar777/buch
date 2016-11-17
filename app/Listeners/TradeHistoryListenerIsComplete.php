<?php

namespace App\Listeners;

use App\Events\TradeIsComplete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerIsComplete
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
     * @param  TradeIsComplete  $event
     * @return void
     */
    public function handle(TradeIsComplete $event)
    {
        //
    }
}
