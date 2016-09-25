<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'classes';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Classes';
}
