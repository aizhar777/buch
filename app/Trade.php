<?php

namespace App;

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
    public $type = 'App\Trade';
}
