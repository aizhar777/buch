<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'types';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\Type';
}
