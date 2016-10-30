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

    public $name = 'Products';
    public $with_div = 6;
    protected $permission = 'view.product';

    /**
     * dropdown links
     *
     * @example Return the links kit "<a href='/#link'>link</a><a href='/#link2'>link2</a>"
     * @return string
     */
    protected function getDropDown()
    {
        return '<li><a href="'.route('products').'">All products</a></li>
        <li><a href="'.route('products.create').'">Create product</a></li>';
    }

    /**
     * Content
     *
     * @return string|null
     */
    protected function getContent()
    {
        $tableOpen = '<table class="table table-hover"> <thead> <tr> 
            <th>#ID</th> 
            <th>Name</th> 
            <th>Description</th> 
            <th>Price</th> 
            <th>Cost</th>
            <th>Is a service</th>
            <th>Balance</th>
            <th>Stock</th>
            <th>Subdivision</th>
            <th>Created</th>
            </tr> </thead> <tbody> ';
        $tBody = '';
        $tbClose = '</tbody> </table>';
        $content = '<div class="alert alert-info">You have no products!</div>';

        $products = Product::with('stock', 'subdivision')->take(5);

        if($products->count() > 0) {
            foreach ($products->get() as $product) {
                $date = date('d-m-Y H:s', strtotime($product->created_at));

                $stock = $product->stock_id . ' stock';
                if($product->stock)
                    $stock = $product->stock->name;

                $subdivision = $product->subdivision_id . ' subdivision';
                if($product->subdivision)
                    $subdivision = $product->subdivision->name;

                $is_service = 'no';
                if ($product->is_service)
                    $is_service = 'yes';

                $description = str_limit($product->description,20);

                $tBody .= "
                <tr> 
                    <th>{$product->id}</th> 
                    <td>{$product->name}</td> 
                    <td>$description</td> 
                    <td>{$product->price}</td> 
                    <td>{$product->cost}</td> 
                    <td>$is_service</td> 
                    <td>{$product->balance}</td> 
                    <td>$stock</td> 
                    <td>$subdivision</td> 
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
        return '
            <li><a href="'.route('products').'">All products</a></li>
            <li><a href="'.route('products.create').'">Create product</a></li>';
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
        return 'fa-product-hunt';
    }
}