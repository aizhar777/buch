<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeHistory extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trade_history';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'id_trade'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_trade',
        'title',
        'description',
        'params',
    ];

    public function trade()
    {
        return $this->belongsTo('App\Trade');
    }
    //
}
