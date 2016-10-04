<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\Modules\User\Http\Requests\EditUserRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class DataController extends Controller
{
    public function userEdit($id, EditUserRequest $request)
    {
        $user = \Auth::user();
        if($user){
            if($user->id != $id) return abort(401); //TODO: add check, current user is admin

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->saveOrFail();

            $bFields = BFields::getInstance();
            $bFields->updateOrCreate($user, $request);
            return redirect()->route('user.profile',$user->id);
        }
    }
}
