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

        $products = Product::all()->take(10);

        if($products->count() > 0) {
            foreach ($products as $product) {
                $date = date('d-m-Y H:s', strtotime($product->created_at));
                $tBody .= "
                <tr> 
                    <th>{$product->id}</th> 
                    <td>{$product->description}</td> 
                    <td>{$product->price}</td> 
                    <td>{$product->cost}</td> 
                    <td>{$product->is_service}</td> 
                    <td>{$product->balance}</td> 
                    <td>{$product->stock_id}</td> 
                    <td>{$product->subdivision_id}</td> 
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