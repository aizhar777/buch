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
    public $type = 'App\TradeStatus';
}
