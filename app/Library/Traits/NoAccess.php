<?php
/**
 * Created by PhpStorm.
 * User: MasterPC
 * Date: 011 11.09.16
 * Time: 17:05
 */

namespace App\Library\Traits;


trait NoAccess
{
    public function noAccess()
    {
        //TODO: сделать вывод что нет доступа
        abort(403);
    }
}