<?php

namespace App;

use App\Modules\Products\Http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'products';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'cost' => 'double',
        'is_service' => 'boolean',
    ];

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Product';


    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE_STOCK = 'App\Product\Stock';


    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE_SUBDIVISION = 'App\Product\Subdivision';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'cost',
        'is_service',
        'balance',
        'stock_id',
        'stock_type',
        'subdivision_id',
        'subdivision_type',
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function subdivision()
    {
        return $this->morphTo();
    }

    /**
     * Get all of the owning commentable models.
     */
    public function stock()
    {
        return $this->morphTo();
    }

    /**
     * Create new product
     *
     * @param CreateProductRequest $request
     * @return bool|static
     */
    public static function createNew(CreateProductRequest $request)
    {
        $stock = Category::whereId($request->get('stock'))->firstOrFail();
        $subdivision = Category::whereId($request->get('subdivision'))->firstOrFail();
        //var_dump($stock->toArray());
        //dd($subdivision->toArray());

        $product = self::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'cost' => $request->get('cost'),
            'is_service' => $request->get('is_service'),
            'balance' => $request->get('balance'),
            'stock_id' => $stock->id,
            'stock_type' => $stock->cat_type,
            'subdivision_id' => $subdivision->id,
            'subdivision_type' => $subdivision->cat_type,
        ]);

        if($product instanceof Product)
            return $product;
        return false;
    }
}
