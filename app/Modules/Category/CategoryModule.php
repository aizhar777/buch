<?php

namespace App\Modules\Category;


use App\Library\Module;

class CategoryModule extends Module
{
    public $name = 'Category';
    public $with_div = 6;
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
        return '
            <li><a href="'.route('category').'">All categories</a></li>
            <li><a href="'.route('category.create').'">Create category</a></li>';
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
        return 'fa-th-list';
    }

}