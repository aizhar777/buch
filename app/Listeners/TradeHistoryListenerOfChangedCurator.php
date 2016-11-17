<?php

namespace App\Listeners;

use App\Events\TradeChangedCurator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOfChangedCurator
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
     * @param  TradeChangedCurator  $event
     * @return void
     */
    public function handle(TradeChangedCurator $event)
    {
        //
    }
}
