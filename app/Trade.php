<?php

namespace App;

use App\Modules\Trade\Http\Requests\CreateTradeRequest;
use App\Modules\Trade\Http\Requests\UpdateTradeRequest;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
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
        return $this->belongsTo('App\Client','client_id');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\User','curator');
    }

    public function completer()
    {
        return $this->belongsTo('App\User','completed_by_user');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product','trades_has_products','trades_id', 'products_id')->with('subdivision', 'stock')->withPivot('quantity')->withTimestamps();
    }

    /**
     * Create New Trade
     *
     * @param CreateTradeRequest $request
     * @return bool|Trade
     * @throws \Exception
     */
    public static function createTradeAndAddProducts(CreateTradeRequest $request)
    {
        $product_options = $request->get('product_options');
        $products = $request->get('products');

        $newPurchase = new Trade([
            'status' => $request->get('status'),
            'ppc' => $request->get('ppc'),
            'curator' => $request->get('curator'),
            'client_id' => $request->get('client_id'),
            'payment_is_completed' => $request->get('payment_is_completed'),
            'completed_by_user' => $request->get('completed_by_user')
        ]);

        \DB::beginTransaction();
        try{
            $newPurchase->saveOrFail();

            foreach ($products as $productId){
                if( !empty($product_options[$productId]) ){
                    $newPurchase->products()->attach($productId, ['quantity' => $product_options[$productId]]);
                }else{
                    throw new \Exception('Empty product options');
                }
            }

        }catch (\Exception $e){
            \DB::rollBack();

            if(config('app.debug')){
                throw $e;
            }

            \Log::error($e->getMessage(),[$e->getLine(),$e->getTraceAsString()]);
            return false;
        }

        \DB::commit();
        return $newPurchase;
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
        $errors = [];

        $product_options = $request->get('product_options');
        $products = $request->get('products');

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
            $errors[] = 'Неудалось обновить trade c ID:'.$trade->id;
        foreach ($products as $product){
            if (!empty($product_options[$product]))
                $trade->products()->updateExistingPivot($product, ['quantity' => $product_options[$product]]);
        }
        if(count($errors))
            return $errors;
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
        //$result = [];

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
                'sum'
            ]);

        $products->thead()
            ->addRowName('head row')
            ->th('head row', 'number', '№')
            ->th('head row', 'name', 'Name')
            ->th('head row', 'description', 'Description')
            ->th('head row', 'price', 'Price')
            ->th('head row', 'quantity', 'Amount')
            ->th('head row', 'stock', 'Stock')
            ->th('head row', 'sub', 'Subdivision')
            ->th('head row', 'sum', 'Sum');

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
            ;

            $id +=1;
            $total += (float)$sum;
        }

        $html = $products->render();
        $html .= '<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">TOTAL: '.number_format($total, 2, '.', ' ').'</p>';
        return $html;
    }
}
