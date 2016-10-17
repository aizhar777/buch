<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'subdivision_id',
        'responsible',
        'address',
    ];

    public function subdivision()
    {
        return $this->belongsTo('App\Subdivision','subdivision_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','responsible', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\products', 'id', 'stock_id');
    }
}
