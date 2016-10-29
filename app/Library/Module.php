<?php

namespace App\Library;


use App\Library\Interfaces\ModuleInterface;
use App\Library\Traits\CurrentUserModel;

abstract class Module implements ModuleInterface
{
    use CurrentUserModel;
    protected $name = 'Module no name';

    protected $permission = null;

    protected $_wrapper = '<div class="col-md-%1$s col-sm-%1$s col-xs-%1$s">%2$s</div>';

    protected $_panel = '<div class="x_panel">%1$s %2$s</div>';

    protected $_panel_header = '<div class="x_title"><h2>%1$s</h2> %2$s <div class="clearfix"></div></div>';

    protected $_dropdown = '<ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle"  data-toggle="dropdown"  role="button"
                                        aria-expanded="false">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                    %s
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>';
    protected $_content = '<div class="x_content">%s</div>';

    protected $_sidebarMenu = '<ul class="nav side-menu"><li>
                        <a><i class="fa %1$s"></i> %2$s <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            %3$s
                        </ul></li></ul>';

    /**
     * Module constructor.
     *
     */
    public function __construct()
    {
    }

    /**
     * HTML Widget
     *
     * @return string|null
     */
    public function widget()
    {
        if($this->check() && is_string($this->getContent()))
            return $this->getWidget();
        return null;
    }

    /**
     * Menu sidebar dropdown
     *
     * @return string|null
     */
    public function menuSidebar()
    {
        if($this->check() && $this->getMenuSidebar() != null)
            return sprintf($this->_sidebarMenu, $this->getMenuSidebarIcon(), $this->name, $this->getMenuSidebar());
        return null;
    }

    /**
     * Check permission
     *
     * @return bool
     */
    public function check():bool
    {
        if ($this->permission == null) return false;
        if(!$this->checkPerm($this->permission))
            return false;
        return true;
    }

    protected $with_div = 12;

    /**
     * Widget wrapper and data
     *
     * @return string
     */
    protected function getWidget()
    {
        return sprintf($this->_wrapper, $this->with_div, $this->getPanel());
    }

    /**
     * html bootstrap panel
     *
     * @return string
     */
    protected function getPanel()
    {
        return sprintf($this->_panel, $this->getPanelHeader(), $this->getDataContent());
    }

    /**
     * bootstrap panel header
     *
     * @return string
     */
    protected function getPanelHeader()
    {
        return sprintf($this->_panel_header, $this->name, $this->getPanelHeaderDropdown());
    }

    /**
     * Bootstrap dropdown
     *
     * @return string
     */
    protected function getPanelHeaderDropdown()
    {
        return sprintf($this->_dropdown, $this->getDropDown());
    }

    /**
     * HTML Content
     *
     * @return string
     */
    protected function getDataContent()
    {
        return sprintf($this->_content, $this->getContent());
    }

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    abstract protected function getDropDown();

    /**
     * Content
     *
     * @return string
     */
    abstract protected function getContent();

    /**
     * Menu sidebar dropdown
     *
     * @example Return the links kit "<li><a href='/#link'>link</a><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    abstract public function getMenuSidebar();

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