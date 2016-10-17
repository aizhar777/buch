<?php

namespace App;

use App\Modules\Products\Http\Requests\CreateProductRequest;
use App\Modules\Products\Http\Requests\EditProductRequest;
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
        'subdivision_id',
    ];

    public function stock()
    {
        return $this->belongsTo('App\Stock', 'stock_id', 'id');
    }

    public function subdivision()
    {
        return $this->belongsTo('App\Subdivision', 'subdivision_id', 'id');
    }

    /**
     * Create new product
     *
     * @param CreateProductRequest $request
     * @return bool|static
     */
    public static function createNew(CreateProductRequest $request)
    {
        $stock =  Stock::find($request->get('stock'))->firstOrFail();
        $subdivision = Subdivision::find($request->get('subdivision'))->firstOrFail();

        $product = self::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'cost' => $request->get('cost'),
            'is_service' => $request->get('is_service'),
            'balance' => $request->get('balance'),
            'stock_id' => $stock->id,
            'subdivision_id' => $subdivision->id,
        ]);

        if($product instanceof Product)
            return $product;
        return false;
    }

    /**
     * Create new product
     *
     * @param CreateProductRequest $request
     * @return bool|static
     */
    public static function updateById($id, EditProductRequest $request)
    {
        $stock =  Stock::find($request->get('stock'))->firstOrFail();
        $subdivision = Subdivision::find($request->get('subdivision'))->firstOrFail();

        $product = self::find($id)->firstOrFail();

        $updatedProduct = $product->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'cost' => $request->get('cost'),
            'is_service' => $request->get('is_service'),
            'balance' => $request->get('balance'),
            'stock_id' => $stock->id,
            'subdivision_id' => $subdivision->id,
        ]);

        if($product instanceof Product)
            return $product;
        return false;
    }

    public static function deleteById($id)
    {
        $product = self::find($id)->firstOrFail();
        if($product->delete())
            return true;
        return false;
    }
}
