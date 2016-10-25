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
    const TYPE = 'App\Trade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'ppc',
        'curator',
        'client_id',
        'payment_is_completed',
        'completed_by_user',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function status()
    {
        return $this->belongsTo('App\TradeStatus');
    }

    public function curator()
    {
        return $this->belongsTo('App\User','curator');
    }

    public function completer()
    {
        return $this->belongsTo('App\User','completed_by_user');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product','trades_has_products','trades_id', 'products_id')->withPivot('quantity');
    }
}
