<?php
/**
 * Created by PhpStorm.
 * User: MasterPC
 * Date: 016 16.10.16
 * Time: 19:12
 */

namespace App\Modules\Products;

use \App\Library\Module;
use App\Product;

class ProductsModule extends Module
{

    public $name = 'products::module.module_name';
    public $with_div = 6;
    protected $permission = 'view.product';
    public $menu_link_format = '<li><a href="%1$s">%2$s</a></li>';
    public $menu_links_array = [
        'products' => 'products::module.module_links.all',
        'products.create' => 'products::module.module_links.create'
    ];

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return $this->createHtmlList();
    }

    /**
     * Content
     *
     * @return string|null
     */
    protected function getContent()
    {
        $tableOpen = '<table class="table table-hover table-responsive"> <thead> <tr> 
            <th>'. trans('products::module.view.id') .'</th> 
            <th>'. trans('products::module.view.name') .'</th> 
            <th>'. trans('products::module.view.price') .'</th> 
            <th>'. trans('products::module.view.cost') .'</th> 
            <th>'. trans('products::module.view.balance') .'</th>
            <th>'. trans('products::module.view.date') .'</th>
            </tr> </thead> <tbody> ';
        $tBody = '';
        $tbClose = '</tbody> </table>';
        $content = '<div class="alert alert-info">'. trans('products::module.messages.not_found') .'</div>';

        $products = Product::with('stock', 'subdivision')->take(5);

        if($products->count() > 0) {
            foreach ($products->get() as $product) {
                $date = date('d-m-Y H:s', strtotime($product->created_at));
                $theService = '<span class="label label-default">'. trans('products::module.is_service') .'</span>';
                $balance = ($product->is_service)? $theService : $product->balance;

                $tBody .= "
                <tr> 
                    <th>{$product->id}</th> 
                    <td>{$product->name}</td> 
                    <td>{$product->price}</td> 
                    <td>{$product->cost}</td> 
                    <td>{$balance}</td> 
                    <td>$date</td> 
                </tr>
            ";
            }
            $content = $tableOpen . $tBody . $tbClose;
        }

        return $content;
    }

    /**
     * Menu sidebar dropdown
     *
     * @example Return the links kit "<li><a href='/#link'>link</a><a href='/#link2'>link2</a></li>"
     * @return string|null
     */
    public function getMenuSidebar()
    {
        return $this->createHtmlList();
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
        return 'fa fa-product-hunt';
    }

    /**
     * Create HTML List links
     *
     * @return null|string
     */
    public function createHtmlList()
    {
        $links = '';
        if (count($this->menu_links_array)) {
            foreach ($this->menu_links_array as $link => $trans){
                $links .= sprintf($this->menu_link_format, route($link), trans($trans));
            }
        }else $links = null;

        return $links;
    }
}