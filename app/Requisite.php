<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'requisites';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Requisite';
}
