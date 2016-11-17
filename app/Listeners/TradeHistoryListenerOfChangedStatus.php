<?php

namespace App\Listeners;

use App\Events\TradeChangedStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOfChangedStatus
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
     * @param  TradeChangedStatus  $event
     * @return void
     */
    public function handle(TradeChangedStatus $event)
    {
        //
    }
}
