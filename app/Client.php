<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'clients';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Client';
}
