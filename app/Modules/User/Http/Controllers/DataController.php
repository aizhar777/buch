<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\Modules\User\Http\Requests\EditUserRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function userEdit($id, EditUserRequest $request)
    {
        $user = \Auth::user();

        if($user instanceof User){
            if($user->id == $id) {
                return $this->updateUser($user, $request);
            }else {
                return $this->updateProfile($id, $request);
            }
        }
        abort(404);
    }

    protected function updateProfile($id, Request $request)
    {
        if(!\Auth::user()->can('edit.user'))
            return $this->noAccess('Not enough rights to edit user');
        $user = User::whereId($id)->firstOrFail();

        return $this->updateUser($user, $request);
    }

    protected function updateUser(User $user, Request $request)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->saveOrFail();

        $user->createImage($request);

        $bFields = BFields::getInstance();
        $bFields->updateOrCreate($user, $request);

        return redirect()->route('user.profile',$user->id);
    }
}
