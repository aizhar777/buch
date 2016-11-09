<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\Permission;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Update user
     *
     * @param $id
     * @return Response
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
     * @return Response
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
     * @return Response
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
        $roles = [];
        $rolesArray = [];
        $allRoles = [];
        $images = null;
        if(empty($user->photos))
            $images = $user->photos;
        if($this->checkPerm('edit.role')){
            $allRoles = Role::all();
        }
        foreach ($user->roles as $role) {
            $rolesArray[] = $role->name;
            $roles[] = $role->id;
        }

        $photo = $user->image;
        $fields = BFields::getInstance()->all($user->id,$user::TYPE);
        return View('user::profile',[
            'user'=> $user,
            'photo'=> $photo,
            'images'=> $images,
            'fields' => $fields,
            'allRoles' => $allRoles,
            'userRoles' => $roles,
            'userRolesArray' => $rolesArray
        ]);
    }

    /**
     * Users list
     *
     * @return Response
     */
    public function usersList()
    {
        if(!$this->checkPerm('view.user'))
            return $this->noAccess();

        $users = User::paginate($this->perPager());
        return view('user::index',['users' => $users]);
    }

    /**
     * Roles list
     *
     * @return Response
     */
    public function rolesAction()
    {
        if(!$this->checkPerm('view.role'))
            return $this->noAccess();

        $roles = Role::paginate($this->perPager());
        return view('user::index_roles',['roles' => $roles]);
    }

    /**
     * Show role by id
     *
     * @param $id
     * @return Response
     */
    public function rolesShowAction($id)
    {
        if(!$this->checkPerm('show.role'))
            return $this->noAccess();

        $role = Role::whereId($id)->with('permissions')->firstOrFail();

        return $this->showRole($role);
    }

    /**
     * Show role by slug
     *
     * @param $slug
     * @return Response
     */
    public function rolesShowBySlugAction($slug)
    {
        if(!$this->checkPerm('show.role'))
            return $this->noAccess();

        $role = Role::whereSlug($slug)->with('permissions')->firstOrFail();

        return $this->showRole($role);
    }

    /**
     * Show role
     *
     * @param Role $role
     * @return Response
     */
    public function showRole(Role $role)
    {
        if(!$this->checkPerm('show.role'))
            return $this->noAccess();

        $permissions = Permission::all();
        $rolePerms = $role->getPermissions();
        $checkEditPerm = $this->checkPerm('edit.permission');
        return view('user::show_role',['role' => $role, 'permissions' => $permissions, 'rolePerms' => $rolePerms, 'checkEditPerm' => $checkEditPerm]);
    }

    /**
     * Create role
     * @param Request $request
     * @return Response
     */
    public function rolesCreateAction(Request $request)
    {
        if(!$this->checkPerm('create.role'))
            return $this->noAccess();

        if($request->isXmlHttpRequest())
            return view('user::ajax.create_role');
        return view('user::create_role');
    }

    /**
     * Update role
     *
     * @return Response
     */
    public function rolesEditAction()
    {
        if(!$this->checkPerm('create.role'))
            return $this->noAccess();
    }

    /**
     * Permissions list
     *
     * @return Response
     */
    public function permissionAction()
    {
        if(!$this->checkPerm('view.permission'))
            return $this->noAccess();

        $perms = Permission::paginate($this->perPager());
        return view('user::index_perms',['perms' => $perms]);
    }

    /**
     * Show Permission
     *
     * @param $id
     * @return Response
     */
    public function permissionShowAction($id)
    {
        if(!$this->checkPerm('show.permission'))
            return $this->noAccess();

        $perm = Permission::whereId($id)->firstOrFail();

        return view('user::show_perm',['perm' => $perm]);
    }

    /**
     * Create Permission
     */
    public function permissionCreateAction()
    {}

    /**
     * Update permission
     * @param $id
     */
    public function rpermissionEditAction($id)
    {}
}
