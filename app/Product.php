<?php

namespace App;

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
}
