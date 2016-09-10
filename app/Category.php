<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'categories';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\Category';
}
