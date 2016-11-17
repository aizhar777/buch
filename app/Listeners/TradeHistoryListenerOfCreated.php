<?php

namespace App\Listeners;

use App\Events\TradeCreated;
use App\Library\Traits\CurrentUserModel;
use App\TradeHistory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOfCreated
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
     * @param  TradeCreated  $event
     * @return void
     */
    public function handle(TradeCreated $event)
    {
        $trade = $event->trade;
        $user = $event->getCreator();

        TradeHistory::create([
            'id_trade' => $trade->id,
            'title' => "Creation of trade#{$trade->id}",
            'description' => "The creator of {$user->id}#{$user->name}",
            'params' => json_encode(['trade' => $trade->toArray()]),
        ]);
    }
}
