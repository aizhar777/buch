<?php
namespace App\Modules\Subdivision;


use App\Library\Module;

class SubdivisionModule extends Module
{
    public $name = 'subdivision::module.module_name';
    public $menu_link_format = '<li><a href="%1$s">%2$s</a></li>';
    public $menu_links_array = [
        'subdivision' => 'subdivision::module.module_links.all',
        'subdivision.create' => 'subdivision::module.module_links.create'
    ];
    protected $permission = 'view.subdivision';
    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return null;
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
     * @example Return the links kit "<li><a href='/#link'>link</a></li><li><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    public function getMenuSidebar()
    {
        $links = '';
        if (count($this->menu_links_array)) {
            foreach ($this->menu_links_array as $link => $trans){
                $links .= sprintf($this->menu_link_format, route($link), trans($trans));
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
        return 'fa fa-briefcase';
    }

}