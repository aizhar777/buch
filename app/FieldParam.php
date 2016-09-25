<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldParam extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'field_params';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\FieldParam';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable =[
        'name',
        'slug',
        'default_value',
        'description',
        'accessory_type' ,
        'is_many_values',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function fields()
    {
        return $this->hasMany('App\Field','param_id','id');
    }
}
