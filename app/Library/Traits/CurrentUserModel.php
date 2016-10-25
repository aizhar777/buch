<?php

namespace App\Library\Traits;


trait CurrentUserModel
{
    /**
     * @return \App\User|mixed|null
     */
    public function getCurrentUser()
    {
        if(\Session::has('current.user')){
            return session('current.user');
        }else{
            $user = \Auth::user();
            \Session::put('current.user',$user);
            return $user;
        }
    }

    /**
     * @return void
     */
    public function reloadCurrentUser()
    {
        \Session::put('current.user', \Auth::user());
    }
}