<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'classes';

    /**
     * Type of relations
     *
     * @var string
     */
    const TYPE = 'App\Classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable =[
        'class',
        'name',
    ];

    public function categories()
    {
        return $this->hasMany('App\Category', 'class', 'cat_type');
    }
}
