<?php

namespace App\Library\Traits;


trait NoAccess
{
    public function noAccess($msg = null)
    {
        $message = 'Forbidden';
        if($msg !== null) $message .= ': '. $msg;
        return view('errors.noaccess',['code' => 403, 'message' => $message]);
    }
}