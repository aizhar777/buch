<?php
/**
 * Created by PhpStorm.
 * User: MasterPC
 * Date: 021 21.10.16
 * Time: 20:10
 */

namespace App\Modules\Stock;


use App\Library\Module;

class StockModule extends Module
{
    public $name = 'Storage';
    protected $permission = 'view.stock';
    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return '<a href="' . route('stock') . '">All store</a><a href="'.route('stock.create').'">Add new store</a>';
    }

    /**
     * Content
     *
     * @return string
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
        return '<li><a href="' . route('stock') . '">All store</a></li><li><a href="'.route('stock.create').'">Add new store</a></li>';
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
        return 'fa fa-hdd-o';
    }


}