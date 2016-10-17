<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subdivisions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'responsible',
        'address',
    ];

    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }

    public function user()
    {
        return $this->belongsTo('App\User','responsible', 'id');
    }
}
