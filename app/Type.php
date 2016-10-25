<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'types';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'class_id',
        'class_type',
        'is_deleted',
    ];
}
