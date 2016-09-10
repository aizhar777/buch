<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldParam extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'field_params';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\FieldParam';
}
