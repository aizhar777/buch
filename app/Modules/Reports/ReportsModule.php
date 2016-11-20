<?php

namespace App\Modules\Reports;


use App\Library\Module;

class ReportsModule extends Module
{
    public $name = 'Reports';
    protected $permission = 'view.trade';
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
        return "<li><a href='".route('reports')."'>All</a></li><li><a href='".route('reports.create')."'>Create</a></li>";
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
        return 'fa-file-text';
    }

}