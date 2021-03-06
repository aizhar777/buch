<?php

namespace App;

use App\Events\TradeCreated;
use App\Events\TradeIncreaseOfItems;
use App\Events\TradeIncreasingTheQuantityProduct;
use App\Events\TradeReducingTheQuantityProduct;
use App\Library\Traits\CurrentUserModel;
use App\Modules\Trade\Http\Requests\AddProductsToTradeRequest;
use App\Modules\Trade\Http\Requests\CreateTradeRequest;
use App\Modules\Trade\Http\Requests\UpdateAmountProductsInTrade;
use App\Modules\Trade\Http\Requests\UpdateTradeRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Trade extends Model
{
    use CurrentUserModel;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'trades';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Trade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'ppc',
        'curator',
        'client_id',
        'payment_is_completed',
        'completed_by_user',
    ];

    public function statuses()
    {
        return $this->belongsTo('App\TradeStatus','status');
    }

    public function ppCode()
    {
        return $this->belongsTo('App\Ppc','ppc');
    }

    public function client()
    {
        return $this->belongsTo('App\Client','client_id')->with('requisites');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\User','curator');
    }

    public function completer()
    {
        return $this->belongsTo('App\User','completed_by_user');
    }

    public function history()
    {
        return $this->hasMany('App\TradeHistory', 'id_trade', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product','trades_has_products','trades_id', 'products_id')->with('subdivision', 'stock')->withPivot('quantity')->withTimestamps();
    }

    /**
     * Create New Trade
     *
     * @param CreateTradeRequest $request
     * @return static
     */
    public static function createTrade(CreateTradeRequest $request)
    {
        return self::create([
            'status' => $request->get('status'),
            'ppc' => $request->get('ppc'),
            'curator' => $request->get('curator'),
            'client_id' => $request->get('client_id'),
            'payment_is_completed' => $request->get('payment_is_completed'),
            'completed_by_user' => $request->get('completed_by_user')
        ]);
    }

    /**
     * Update trade and quantity products
     *
     * @param UpdateTradeRequest $request
     * @param $id
     * @return array|bool
     */
    public static function updateTradeandProducts(UpdateTradeRequest $request, $id)
    {

        $trade = self::whereId($id)->with('statuses','ppCode','client','supervisor','completer','products')->firstOrFail();

        if($trade->status !== $request->get('status'))
            $trade->status = $request->get('status');

        if($trade->ppc !== $request->get('ppc'))
            $trade->ppc = $request->get('ppc');

        if($trade->curator !== $request->get('curator'))
            $trade->curator = $request->get('curator');

        if($trade->payment_is_completed !== $request->get('payment_is_completed'))
            $trade->payment_is_completed = $request->get('payment_is_completed');

        if($trade->completed_by_user !== $request->get('completed_by_user'))
            $trade->completed_by_user = $request->get('completed_by_user');

        if(!$trade->save())
            return false;
        return true;
    }

    /**
     * Find Trade by id
     *
     * @param $id
     * @return Trade
     */
    public static function findByIdWithAllRelations($id)
    {
        $trade = self::whereId($id)
            ->with([
                'statuses',
                'ppCode',
                'client',
                'supervisor',
                'completer',
                'products.stock',
            ])
            ->firstOrFail();

        return $trade;
    }

    /**
     * @param AddProductsToTradeRequest $request
     * @return Model|static
     * @throws \Exception
     */
    public static function addProducts(AddProductsToTradeRequest $request)
    {
        $trade = self::whereId($request->get('trade'))->firstOrFail();
        $products = $request->get('products');
        $product_options = $request->get('product_options');

        foreach ($products as $productId){
            if( !empty($product_options[$productId]) ){
                $trade->products()->attach($productId, ['quantity' => $product_options[$productId]]);
            }else{
                throw new \Exception('Empty product options');
            }
        }
        event(new TradeIncreaseOfItems($trade,$trade->getCurrentUser(), $product_options));
        return $trade;
    }

    /**
     * Generate html table of trade products
     *
     * @param string $cssClass
     * @return string|null
     */
    public function getProductsAsHtmlTable($cssClass = null)
    {
        if(!$this->products->count())
            return null;

        if(empty($cssClass))
            $cssClass = 'table table-bordered';

        $products = \Cell::create()
            ->addClass($cssClass)
            ->addColNames([
                'number',
                'name',
                'description',
                'price',
                'quantity',
                'stock',
                'sub',
                'sum',
                'action'
            ]);

        $action = '
        <!-- Single button -->
        ';

        $products->thead()
            ->addRowName('head row')
            ->th('head row', 'number', '№')
            ->th('head row', 'name', 'Name')
            ->th('head row', 'description', 'Description')
            ->th('head row', 'price', 'Price')
            ->th('head row', 'quantity', 'Amount')
            ->th('head row', 'stock', 'Stock')
            ->th('head row', 'sub', 'Subdivision')
            ->th('head row', 'sum', 'Sum')
            ->th('head row', 'action', 'Action');

        $id = 1;
        $total = 0.00;

        foreach ($this->products as $product){

            $sum = (float)$product->price * (float)$product->pivot->quantity;

            $products->addRow($product->id)
                ->tdOpenEnd('number', $id)
                ->tdOpenEnd('name', $product->name)
                ->tdOpenEnd('description', str_limit($product->description, 150))
                ->tdOpenEnd('price', number_format($product->price, 2, '.', ' '))
                ->tdOpenEnd('quantity', $product->pivot->quantity)
                ->tdOpenEnd('stock', $product->stock->name)
                ->tdOpenEnd('sub', $product->subdivision->name)
                ->tdOpenEnd('sum', number_format($sum, 2, '.', ' '))
                ->tdOpenEnd('action', $action);

            $id +=1;
            $total += (float)$sum;
        }

        $html = $products->render();
        $html .= '<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">TOTAL: '.number_format($total, 2, '.', ' ').'</p>';
        return $html;
    }

    /**
     * Update quantity in pivot table
     *
     * @param UpdateAmountProductsInTrade $request
     * @return Trade|null
     */
    public static function updateProductQuantity(UpdateAmountProductsInTrade $request)
    {
        $trade = self::where('id', '=',$request->get('trade'))->with('products')->firstOrFail();
        $product = $trade->products()->where('products_id', '=', $request->get('product'))->firstOrFail();
        $amount = $request->get('amount');
        $quantity = $product->pivot->quantity;
        if($quantity == $amount) return null;
        elseif($quantity > $amount) {
            $balance = ($quantity - $amount);
            $product->balance += $balance;
            $event = new TradeReducingTheQuantityProduct($product, $amount);
        }else{
            $balance = ($amount - $quantity);
            $product->balance -= $balance;
            $event = new TradeIncreasingTheQuantityProduct($product, $amount);
        }

        if(config('company.update_balans_product')){
            $product->save();
        }

        $trade->products()->updateExistingPivot($product->id, ['quantity' => $amount]);

        event($event);

        return $trade;
    }
}
