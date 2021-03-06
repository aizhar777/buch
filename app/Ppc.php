<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppc extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ppc';

    protected $fillable = [
        'code',
        'description'
    ];

    public static function searchPpc($string)
    {
        $result = self::whereRaw('MATCH(code,description) AGAINST(? IN BOOLEAN MODE)',[$string])->get();

        if($result->count() == 0)
            return false;
        return $result;
    }
}
