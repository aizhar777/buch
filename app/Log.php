<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'log';

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\Log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log_type', 'description', 'user_id','params',
    ];
}
