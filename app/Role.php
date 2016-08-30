<?php

namespace App;

use Caffeinated\Shinobi\Models\Role as Model;

class Role extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'special'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Roles can have many permissions.
     *
     * @return Model
     */
    public function permissions()
    {
        return $this->belongsToMany('\App\Permission')->withTimestamps();
    }
}
