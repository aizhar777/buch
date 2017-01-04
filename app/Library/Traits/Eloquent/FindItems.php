<?php

namespace App\Library\Traits\Eloquent;


trait FindItems
{
    public static function findById(int $id)
    {
        return self::where('id', $id)->first();
    }
}