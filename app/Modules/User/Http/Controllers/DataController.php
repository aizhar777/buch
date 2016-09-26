<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function userEdit($id, Request $request)
    {
        //TODO check permissions on edit user
        $user = \Auth::user();
        if($user->id != $id) return abort(401); //TODO: add check, current user is admin
        $bFields = BFields::getInstance();
        $bFields->updateOrCreate($user, $request);
        return redirect()->route('user.profile',$user->id);
    }
}
