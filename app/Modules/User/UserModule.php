<?php

namespace App\Modules\User;


use App\Library\Module;
use App\User;

class UserModule extends Module
{
    public $name = 'user::module.module_name';
    public $with_div = 6;
    protected $permission = 'view.user';
    protected $create_user = 'create.user';
    protected $view_roles = 'view.role';
    protected $view_perms = 'view.permission';
    protected $link_format = '<li><a href="%1$s">%2$s</a></li>';
    protected $icon_class = 'fa fa-users';
    protected $module_links = [
        'view.user' => [
            ['user', 'user::module.module_links.all']
        ],
        'create.user' => [
            ['user.create', 'user::module.module_links.create']
        ],
        'view.role' => [
            ['user.roles', 'user::module.module_links.roles']
        ],
        'view.permission' => [
            ['user.perms', 'user::module.module_links.permissions']
        ],
    ];

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
        $tableOpen = '<table class="table table-hover table-responsive"> <thead> <tr> <th>#ID</th> <th>First Name</th> <th>E-Mail</th><th>Reg date</th></tr> </thead> <tbody> ';
        $tBody = '';
        $tbClose = '</tbody> </table>';

        $users = User::all()->take(10);

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
     * @return string|null
     */
    public function getMenuSidebar()
    {
        $list = '';
        foreach ($this->module_links as $permission => $array_links){
            if($this->check($permission)){
                foreach ($array_links as $link) {
                    $list .= sprintf($this->link_format, route($link[0]), trans($link[1]));
                }
            }
        }
        return $list;
    }


}