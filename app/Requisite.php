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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'legal_name',
        'bank',
        'iik',
        'bin',
        'cbe',
        'relation_id',
        'relation_type',
    ];

    public function relation()
    {
        return $this->morphTo();
    }
}
