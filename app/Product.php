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
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Product';
}
