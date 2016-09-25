<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\User;
use Illuminate\Http\Request;

use App\Library\Traits\NoAccess;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use NoAccess;

    /**
     * User profile action
     *
     * @param null $id
     * @return User|array
     */
    public function userProfile($id = null)
    {
        $user = \Auth::user();

        if ($id !== null and $user->id != $id) {
            $user = User::findOrFail($id);
            return $this->showUser($user);
        } else {
            return $this->showProfile($user);
        }
    }

    /**
     * Show user
     *
     * @param User $user
     * @return array
     */
    public function showUser(User $user)
    {
        if(!$user->can('view.user')) $this->noAccess();

        return [
            'self',
            $user
        ];
    }


    /**
     * Show Current user profile
     *
     * @param User $user
     * @return User
     */
    public function showProfile(User $user)
    {
        $fields = BFields::getInstance()->all($user->id,$user::TYPE);
        return View('user::profile',[
            'user'=> $user,
            'fields' => $fields
        ]);
    }
}
