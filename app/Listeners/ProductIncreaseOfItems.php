<?php

namespace App\Listeners;

use App\Events\TradeIncreaseOfItems;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductIncreaseOfItems
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
     * @param  TradeIncreaseOfItems  $event
     * @return void
     */
    public function handle(TradeIncreaseOfItems $event)
    {
        foreach ($event->trade->products as $product){
            if( !$product->takeItem($product->pivot->quantity) ){
                \Log::error("Failed to reduce the balance", $product->toArray());
            }
        }
        //
    }
}
