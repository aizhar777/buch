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
     * @return Response
     */
    public function userProfile($id = null)
    {
        $user = User::where('id',$id)->firstOrFail();
        if ($id != null and !$user->is_current()) {
            return $this->showUser($user);
        } else {
            return $this->showProfile($user);
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
            return $this->noAccess( trans('user::module.messages.access_denied') );
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
        $fields = BFields::getInstance()->all($user->id, $user::TYPE);
        $roles  = Role::all();
        return View('user::profile_edit',[
            'user'    => $user,
            'fields'  => $fields,
            'u_roles' => $user->roles,
            'roles'   => $roles
        ]);
    }

    /**
     * Show user
     *
     * @param User $user
     * @return Response
     */
    public function showUser(User $user)
    {
        if(!$this->checkPerm('show.user'))
            return $this->noAccess( trans('user::module.messages.access_denied') );
        return $this->showProfile($user);
    }


    /**
     * Show Current user profile
     *
     * @param User $user
     * @return Response
     */
    public function showProfile(User $user)
    {
        $roles = [];
        $rolesArray = [];
        $allRoles = [];
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
            'images'=> $user->findAllImages(),
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
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

        $roles = Role::all();
        if($request->isXmlHttpRequest())
            return view('user::ajax.create_role',['roles' => $roles]);
        return view('user::create_role',['roles' => $roles]);
    }

    /**
     * Update role
     *
     * @param string $slug
     * @return Response
     */
    public function rolesEditAction($slug)
    {
        if(!$this->checkPerm('edit.role'))
            return $this->noAccess( trans('user::module.messages.access_denied') );
        $role = Role::where('slug', $slug)->firstOrFail();

        return view('user::edit_role',['role' => $role]);
    }

    /**
     * Permissions list
     *
     * @return Response
     */
    public function permissionAction()
    {
        if(!$this->checkPerm('view.permission'))
            return $this->noAccess( trans('user::module.messages.access_denied') );

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
            return $this->noAccess( trans('user::module.messages.access_denied') );

        $perm = Permission::whereId($id)->firstOrFail();

        return view('user::show_perm',['perm' => $perm]);
    }

    /**
     * Create a user action
     *
     * @return Response
     */
    public function userCreate()
    {
        if(!$this->checkPerm('create.user'))
            return $this->noAccess( trans('user::module.messages.access_denied') );
        $roles = Role::all();

        return view('user::createUser',['roles' => $roles]);
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
    public function permissionEditAction($id)
    {}
}
