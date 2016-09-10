<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'fields';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\Field';

}
