<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'settings';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\Setting';
}
