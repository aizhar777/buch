<?php

namespace App\Modules\Trade;


use App\Library\Module;

class TradeModule extends Module
{
    protected $name = 'Trade';
    protected $permission = 'view.trade';
    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string|null
     */
    protected function getDropDown()
    {
        return null;
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
        return '<li><a href="' . route('trade') .'">Trade</a></li><li><a href="' . route('trade.create') .'">Create Trade</a></li>';
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
        return 'fa-money'; //
    }

}