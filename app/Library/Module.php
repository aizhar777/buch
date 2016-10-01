<?php

namespace App\Library;


use App\Library\Interfaces\ModuleInterface;

abstract class Module implements ModuleInterface
{
    protected $name = 'Module no name';

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

    /**
     * Module constructor.
     *
     */
    public function __construct()
    {}

    protected $with_div = 12;

    /**
     * HTML Widget
     *
     * @return string
     */
    public function widget()
    {
        return $this->getWidget();
    }

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
}