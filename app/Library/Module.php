<?php

namespace App\Library;


use App\Library\Interfaces\ModuleInterface;
use App\Library\Traits\CurrentUserModel;

abstract class Module implements ModuleInterface
{
    use CurrentUserModel;
    protected $name = 'Module no name';

    protected $permission = null;

    protected $with_div = 12;

    protected $with_sm = 6;
    protected $with_xs = 13;
    protected $with_md = 4;
/*
      <!-- Default box -->


        Title

        <div class="box-body" style="display: block;">
          Start creating your amazing application!
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="display: block;">
          Footer
        </div>
        <!-- /.box-footer-->
*/

    protected $_wrapper = '<div class="col-md-%1$s col-sm-%1$s col-xs-12"><div class="box">%2$s</div></div>';

    protected $_panel = '<div class="x_panel">%1$s %2$s</div>';

    protected $_panel_header = '<div class="box-header with-border"><h3 class="box-title">%1$s</h3>
          <div class="box-tools pull-right">%2$s
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button></div></div>';

    protected $_dropdown = '<div class="btn-group"><button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa phpdebugbar-fa-arrow-down"></i></button><ul class="dropdown-menu" role="menu"> %s </ul></div>';

    protected $_content = '<div class="x_content">%s</div>';

    protected $_sidebarMenu = '<li class="treeview">
                <a href="#"><i class="fa %1$s"></i> <span> %2$s </span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">%3$s</ul></li>';

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
     * @param string $perm
     * @return bool
     */
    public function check($perm = null):bool
    {
        $permission = '';
        if($perm == null){
            if ($this->permission == null) return false;
            $permission = $this->permission;
        }else{
            $permission = $perm;
        }

        if(!$this->checkPerm($permission))
            return false;
        return true;
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

    /**
     * Menu sidebar dropdown
     *
     * @example Return the links kit "<li><a href='/#link'>link</a></li><li><a href='/#link2'>link2</a></li>"
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