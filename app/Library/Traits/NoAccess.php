<?php

namespace App\Library\Traits;


trait NoAccess
{
    public function noAccess()
    {
        //TODO: сделать вывод что нет доступа
        abort(403);
    }
}