<?php

namespace App\Library\Traits;


use App\User;

trait CurrentUserModel
{
    /**
     * @return \App\User
     */
    public function getCurrentUser()
    {
        if(\Session::has('current.user')){
            $user = \Session::get('current.user');
        }else{
            $user = \Auth::user();
            \Session::put('current.user',$user);
        }
        return $user;
    }

    /**
     * Update current user in session
     *
     * @param User|null $user
     * @return void
     */
    public function reloadCurrentUser(User $user = null)
    {
        \Session::remove('current.user');
        \Session::put('current.user', User::getCurrentWithAllRealtionsOrAuthUser());
    }

    /**
     * @return void
     */
    public function reloadUserPermissions()
    {
        \Session::put('current.perms', $this->getCurrentUser()->getPermissions());
    }

    /**
     * @return void
     */
    public function reloadUserRoles()
    {
        \Session::put('current.roles', $this->getCurrentUser()->roles()->get());
    }

    /**
     * Check permission on current user
     *
     * @param $permission
     * @return bool
     */
    public function checkPerm($permission, $full = false)
    {
        $check = false;

        if(!$full){
            if(in_array($permission, $this->getPerms()))
                $check = true;
        }else{
            $check = $this->checkFullPerm($permission);
        }
        return $check;
    }

    /**
     * Check permission on current user
     *
     * @param $permission
     * @return bool
     */
    public function checkFullPerm($permission)
    {
        $can = false;

        foreach ($this->getCurrentUserRoles() as $role) {

            if ($role->special === 'no-access') {
                return false;
            }

            if ($role->special === 'all-access') {
                return true;
            }

            if ($role->can($permission)) {
                $can = true;
            }
        }

        return $can;
    }

    /**
     * Permissions array
     *
     * @return array
     */
    public function getPerms()
    {
        if(\Session::has('current.perms')){
            $perms = session('current.perms');
        }else{
            $perms = \Auth::user()->getPermissions();
            \Session::put('current.perms',$perms);
        }
        return $perms;
    }

    /**
     * Checks if the user has the given role.
     *
     * @param  string $slug
     * @return bool
     */
    public function isUserRole($slug)
    {
        $slug = strtolower($slug);
        $roles = $this->getCurrentUserRoles();
        foreach ($roles as $role) {
            if ($role->slug == $slug) return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCurrentUserRoles()
    {
        if(\Session::has('current.roles')){
            $roles = session('current.roles');
        }else{
            $roles = $this->getCurrentUser()->roles()->get();
            \Session::put('current.roles',$roles);
        }
        return $roles;
    }


}