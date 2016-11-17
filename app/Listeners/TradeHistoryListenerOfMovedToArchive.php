<?php

namespace App\Listeners;

use App\Events\TradeMovedToArchive;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOfMovedToArchive
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
     * @param  TradeMovedToArchive  $event
     * @return void
     */
    public function handle(TradeMovedToArchive $event)
    {
        //
    }
}
