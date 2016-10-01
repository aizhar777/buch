<?php

namespace App\Modules\User;


use App\Library\Module;
use App\User;

class UserModule extends Module
{
    public $name = 'Users';

    /**
     * dropdown links
     *
     * @return string
     */
    protected function getDropDown()
    {
        return '<a href="/users/list"> All users</a>';
    }

    /**
     * Content
     *
     * @return string
     */
    protected function getContent()
    {
        $tableOpen = '<table class="table table-hover"> <thead> <tr> <th>#ID</th> <th>First Name</th> <th>E-Mail</th><th>Reg date</th></tr> </thead> <tbody> ';
        $tBody = '';
        $tbClose = '</tbody> </table>';

        $users = User::all(['id','name','email','created_at'])->take(10);

        foreach ($users as $user){
            $tBody .= "
                <tr> 
                    <th>{$user->id}</th> 
                    <td>{$user->name}</td> 
                    <td>{$user->email}</td> 
                    <td>{$user->created_at}</td> 
                </tr>
            ";
        }
        return $tableOpen . $tBody . $tbClose;
    }

}