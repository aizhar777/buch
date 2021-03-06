<?php
/**
 * Created by PhpStorm.
 * User: NoteBook
 * Date: 01.10.2016
 * Time: 18:28
 */

namespace App\Library\Interfaces;


interface ModuleInterface
{
    /**
     * Widget method
     *
     * @return string|null
    */
    public function widget();

    /**
     * Menu sidebar dropdown
     *
     * @return string|null
    */
    public function menuSidebar();
}