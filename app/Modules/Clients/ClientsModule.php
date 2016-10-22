<?php

namespace App\Modules\Clients;


use App\Client;
use App\Library\Module;
use App\User;

class ClientsModule extends Module
{
    public $name = 'Clients';
    public $with_div = 6;
    protected $permission = 'view.client';

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return '<li><a href="'.route('clients').'">All client</a></li>
        <li><a href="'.route('clients.create').'">Create client</a></li>';
    }

    /**
     * Content
     *
     * @return string|null
     */
    protected function getContent()
    {
        $tableOpen = '<table class="table table-hover"> <thead> <tr> <th>#ID</th> <th>Name</th> <th>E-Mail</th> <th>Phone</th> <th>Curator</th><th>Reg date</th></tr> </thead> <tbody> ';
        $tBody = '';
        $tbClose = '</tbody> </table>';
        $content = '<div class="alert alert-info">You have no clients!</div>';

        $clients = Client::all()->take(10);

        if($clients->count() > 0) {
            foreach ($clients as $client) {
                $date = date('d-m-Y H:s', strtotime($client->created_at));
                $curator = 'none';
                if ($client->supervise instanceof User) {
                    $curator = '<a href="' . route('user.profile', ['id' => $client->supervise->id]) . '">' . $client->supervise->name . '</a>';
                }
                $tBody .= "
                <tr> 
                    <th>{$client->id}</th> 
                    <td>{$client->name}</td> 
                    <td>{$client->email}</td> 
                    <td>{$client->phone}</td> 
                    <td>{$curator}</td> 
                    <td>$date</td> 
                </tr>
            ";
            }
            $content = $tableOpen . $tBody . $tbClose;
        }

        return $content;
    }

    /**
     * Menu sidebar dropdown
     *
     * @example Return the links kit "<li><a href='/#link'>link</a><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    public function getMenuSidebar()
    {
        return '
            <li><a href="'.route('clients').'">All clients</a></li>
            <li><a href="'.route('clients.create').'">Create client</a></li>';
    }

    /**
     * Menu sidebar dropdown icon
     * Font Awesome Icon
     *
     * @example fa-list
     * @return string
     */
    public function getMenuSidebarIcon()
    {
        return 'fa-users';
    }
}