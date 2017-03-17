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
    public $name = 'stock::module.module_name';
    protected $permission = 'view.stock';
    public $menu_list_link_format = '<li><a href="%1$s">%2$s</a></li>';
    public $menu_link_format = '<a href="%1$s">%2$s</a>';
    public $menu_links_array = [
        'stock' => 'stock::module.module_links.all',
        'stock.create' => 'stock::module.module_links.create'
    ];
    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return $this->getHtmlLinks(false);
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
        return $this->getHtmlLinks(true);
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

    /**
     * Get html links
     *
     * @param bool $hasList
     * @return null|string
     */
    public function getHtmlLinks($hasList = false)
    {
        $linksArray = ($hasList)? $this->menu_list_link_format: $this->menu_link_format;
        $links = '';
        if (count($this->menu_links_array)) {
            foreach ($this->menu_links_array as $link => $trans){
                $links .= sprintf($linksArray, route($link), trans($trans));
            }
        }else $links = null;

        return $links;
    }


}