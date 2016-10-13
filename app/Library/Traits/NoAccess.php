<?php

namespace App\Library\Traits;


trait NoAccess
{
    public function noAccess($msg = null)
    {
        $message = 'Forbidden';
        if($msg !== null) $message .= ': '. $msg;
        \Flash::error($message);
        return abort(403);
    }
}