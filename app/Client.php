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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'email',
        'phone',
        'curator',
    ];

    public function requisites()
    {
        return $this->morphMany('App\Requisite', 'relation');
    }



}
