<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'trade_statuses';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\TradeStatus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
    ];

    public function trades()
    {
        return $this->hasMany('App\Trade','id', 'status');
    }
}
