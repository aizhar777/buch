<?php

namespace App\Modules\Clients;


use App\Library\Module;

class ClientsModule extends Module
{
    public $name = 'Clients';
    public $with_div = 6;

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return '<li><a href="#'.route('clients.create').'">Create client</a></li>';
    }

    /**
     * Content
     *
     * @return string|null
     */
    protected function getContent()
    {
        return null;
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