<?php

namespace App\Listeners;

use App\Events\TradeIncreaseOfItems;
use App\Trade;
use App\TradeHistory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOnIncreaseOfItems
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
        $trade = $event->trade;
        $user = $event->getCreator();

        TradeHistory::create([
            'id_trade' => $trade->id,
            'title' => "{$user->id}#{$user->name} added products",
            'description' => "The creator of {$user->id}#{$user->name}<br>Products" . $this->htmlProductList($trade),
            'params' => json_encode(['products' => $trade->products->toArray()]),
        ]);
    }

    public function htmlProductList(Trade $trade)
    {
        $html = "<ul>";
        foreach ($trade->products as $product){
            $html .= '<li>' . $product->name . ' (' . $product->pivot->quantity . ') price of ' . number_format($product->price, 2, '.', ' ') . '</li>';
        }
        return $html.'</ul>';
    }
}
