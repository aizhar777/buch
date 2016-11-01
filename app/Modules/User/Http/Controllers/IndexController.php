<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\Permission;
use App\Role;
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
        $profile = $this->getCurrentUser();

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
        $user = $this->getCurrentUser();
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
        if(!$this->checkPerm('edit.user'))
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
        if(!$this->checkPerm('show.user'))
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

    public function usersList()
    {
        if(!$this->checkPerm('view.user'))
            return $this->noAccess();
        $users = User::paginate(10);
        return view('user::index',['users' => $users]);
    }

    public function rolesAction()
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of roles
            return $this->noAccess();

        $roles = Role::paginate(10);
        return view('user::index_roles',['roles' => $roles]);
    }

    public function rolesShowAction($id)
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of roles
            return $this->noAccess();

        $role = Role::whereId($id)->firstOrFail();

        return $this->showRole($role);
    }

    public function rolesShowBySlugAction($slug)
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of roles
            return $this->noAccess();

        $role = Role::whereSlug($slug)->firstOrFail();

        return $this->showRole($role);
    }

    public function showRole(Role $role)
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of roles
            return $this->noAccess();

        return view('user::show_role',['role' => $role]);
    }

    public function rolesCreateAction(){}
    public function rolesEditAction(){}

    public function permissionAction()
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of permissions
            return $this->noAccess();

        $perms = Permission::paginate(10);
        return view('user::index_perms',['perms' => $perms]);
    }

    public function permissionShowAction($id)
    {
        if(!$this->checkPerm('view.user')) //TODO: check permissions to view of roles
            return $this->noAccess();

        $perm = Permission::whereId($id)->firstOrFail();

        return view('user::show_perm',['perm' => $perm]);
    }
    public function permissionCreateAction(){}
    public function rpermissionEditAction(){}
}
