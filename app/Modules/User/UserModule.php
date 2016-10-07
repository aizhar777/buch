<?php

namespace App\Modules\User;


use App\Library\Module;
use App\User;

class UserModule extends Module
{
    public $name = 'Users';
    public $with_div = 6;

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

        $users = User::all(['id','name','email','created_at','updated_at'])->take(10);

        foreach ($users as $user){
            $date = date('d-m-Y H:s', strtotime($user->created_at));
            $tBody .= "
                <tr> 
                    <th>{$user->id}</th> 
                    <td>{$user->name}</td> 
                    <td>{$user->email}</td> 
                    <td>$date</td> 
                </tr>
            ";
        }
        return $tableOpen . $tBody . $tbClose;
    }

    /**
     * Menu sidebar dropdown
     *
     * @example Return the links kit "<li><a href='/#link'>link</a><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    public function getMenuSidebar()
    {
        return null;
    }


}