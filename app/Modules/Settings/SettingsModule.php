<?php

namespace App\Modules\Settings;


use App\Library\Module;

class SettingsModule extends Module
{
    public $name = 'settings::module.module_name';
    protected $permission = 'view.settings';
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
     * @example Return the links kit "<li><a href='/#link'>link</a><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    public function getMenuSidebar()
    {
        return '<li><a href="'.route('settings').'">' . trans('settings::module.module_links.all') . '</a></li>';
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
        return 'fa fa-cogs';
    }

}