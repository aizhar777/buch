<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\User;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * User profile action
     *
     * @param null $id
     * @return \Response
     */
    public function userProfile($id = null)
    {
        $profile = \Auth::user();

        if ($id !== null and $profile->id != $id) {
            $user = User::findOrFail($id);
            return $this->showUser($user);
        } else {
            return $this->showProfile($profile);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userEdit($id)
    {
        $user = \Auth::user();
        if($user->id == $id)
            return $this->editAction($user);

        $profile = User::whereId($id)->firstOrFail();
        return $this->checkAndEditAction($profile);
    }

    /**
     * Check permissions and Edit Action
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkAndEditAction(User $user)
    {
        if(!\Auth::user()->can('edit.user'))
            return $this->noAccess();
        return $this->editAction($user);
    }

    /**
     * Edit user action
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAction(User $user)
    {
        $fields = BFields::getInstance()->all($user->id,$user::TYPE);
        return View('user::profile_edit',[
            'user'=> $user,
            'fields' => $fields
        ]);
    }

    /**
     * Show user
     *
     * @param User $user
     * @return array
     */
    public function showUser(User $user)
    {
        if(!\Auth::user()->can('show.user'))
            return $this->noAccess();
        return $this->showProfile($user);
    }


    /**
     * Show Current user profile
     *
     * @param User $user
     * @return User
     */
    public function showProfile(User $user)
    {
        if(empty($user->photos)) {
            $images = null;
            $pfoto = null;
        }else{
            $pfoto = $user->photos()->first();
            $images = $user->photos;
        }
        $fields = BFields::getInstance()->all($user->id,$user::TYPE);
        return View('user::profile',[
            'user'=> $user,
            'photo'=> $pfoto,
            'images'=> $images,
            'fields' => $fields
        ]);
    }
}
