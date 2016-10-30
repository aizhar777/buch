<?php

namespace App\Library\Facades;


use Illuminate\Support\Facades\Facade;

class NumberToStringFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'NumberToString';
    }
}