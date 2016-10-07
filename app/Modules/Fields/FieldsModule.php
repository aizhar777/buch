<?php

namespace App\Modules\Fields;


use App\Library\Module;

class FieldsModule extends Module
{
    public $name = 'Fields';

    /**
     * @return null
     */
    public function widget()
    {
        return null;
    }

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return '';
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
        return '
        <li><a href="/fields"> List Fields</a></li>
        <li><a href="/fields/add"> Add Fields</a></li>
        ';
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
        return 'fa-list';
    }


}