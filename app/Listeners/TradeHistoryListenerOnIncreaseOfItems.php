<?php

namespace App\Listeners;

use App\Events\TradeIncreaseOfItems;
use App\Product;
use App\Trade;
use App\TradeHistory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeHistoryListenerOnIncreaseOfItems
{
    /**
     * @var array $products
     */
    public $products;

    /**
     * Handle the event.
     *
     * @param  TradeIncreaseOfItems  $event
     * @return void
     */
    public function handle(TradeIncreaseOfItems $event)
    {
        $trade = $event->trade;
        $this->products = $event->products;
        $user = $event->getCreator();

        if($event->products == null)
            $products = $this->getProducts($event->trade);
        elseif(is_array($this->products))
            $products = $this->getProducts($this->products);
        else return;

        TradeHistory::create([
            'id_trade' => $trade->id,
            'title' => "{$user->id}#{$user->name} added products",
            'description' => "The creator of {$user->id}#{$user->name}<br>Products" . $this->htmlProductList($products),
            'params' => json_encode(['products' => $products->toArray()]),
        ]);
    }

    /**
     * Create html list of products
     *
     * @param \Illuminate\Database\Eloquent\Collection $products
     * @return string
     */
    public function htmlProductList(\Illuminate\Database\Eloquent\Collection $products)
    {
        $html = "<ul>";
        foreach ($products as $product){
            $html .= '<li>' . $product->name . ' (' . $this->products[$product->id] . ') cost of ' . number_format(($product->price * $this->products[$product->id]), 2, '.', ' ') . config('company.currency') . '</li>';
        }
        return $html.'</ul>';
    }

    /**
     * Get the products of trade or an array of id
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    protected function getProducts($data)
    {
        if ($data instanceof Trade) return $data->products;
        elseif (is_array($data)) return Product::whereIn('id', array_keys($data))->get();
        else return null;
    }
}
