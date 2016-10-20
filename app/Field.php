<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'fields';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Field';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['is_hidden' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable =[
        'name',
        'slug',
        'value',
        'param_id',
        'default_value',
        'accessory_id' ,
        'accessory_type',
        'is_hidden',
    ];


    /**
     * Get all of the owning commentable models.
     */
    public function accessory()
    {
        return $this->morphTo();
    }

    /**
     * Get the post that owns the comment.
     */
    public function params()
    {
        return $this->belongsTo('App\FieldParam', 'param_id');
    }
}
