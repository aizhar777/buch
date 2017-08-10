<?php

namespace App\Modules\Clients;


use App\Client;
use App\Library\Module;
use App\User;

class ClientsModule extends Module
{
    public $name = 'clients::module.module_name';
    public $with_div = 6;
    protected $permission = 'view.client';
    public $menu_list_link_format = '<li><a href="%1$s">%2$s</a></li>';
    public $menu_link_format = '<a href="%1$s">%2$s</a>';
    public $menu_links_array = [
        'clients' => 'clients::module.module_links.all',
        'clients.create' => 'clients::module.module_links.create'
    ];

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return $this->createHtmlLinks();
    }

    /**
     * Content
     *
     * @return string|null
     */
    protected function getContent()
    {
        $tableOpen = '<table class="table table-hover table-responsive"> <thead> <tr><th>#ID</th>
<th>'.trans('clients::module.view.name').'</th><th>'.trans('clients::module.view.email').'</th>
<th>'.trans('clients::module.view.phone').'</th><th>'.trans('clients::module.view.curator').'</th>
<th>'.trans('clients::module.view.reg_date').'</th></tr> </thead> <tbody>';
        $tBody = '';
        $tbClose = '</tbody> </table>';
        $content = '<div class="alert alert-info">'.trans('clients::module.messages.not_found').'</div>';

        $clients = Client::with('supervise')->take(10)->get();

        if($clients->count() > 0) {

            foreach ($clients as $client) {
                $date = date('d-m-Y H:s', strtotime($client->created_at));
                $curator = trans('clients::module.none');
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
        return $this->createHtmlLinks();
    }


    /**
     * @param bool $has_list
     * @return null|string
     */
    public function createHtmlLinks($has_list = true)
    {
        $format = ($has_list)? $this->menu_list_link_format : $this->menu_link_format;
        $links = '';
        if (count($this->menu_links_array)) {
            foreach ($this->menu_links_array as $link => $trans){
                $links .= sprintf($format, route($link), trans($trans));
            }
        }else $links = null;

        return $links;
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
        return 'fa fa-users';
    }
}