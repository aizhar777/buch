<?php

namespace App\Modules\Products\Http\Controllers;

use App\Client;
use App\Modules\Products\Http\Requests\CreateProductRequest;
use App\Modules\Products\Http\Requests\EditProductRequest;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DataController extends Controller
{
    /**
     * Create new product action
     *
     */
    public function create(CreateProductRequest $request)
    {
        $product = Product::createNew($request);
        if($product){
            \Flash::success('New product created!');
            return redirect()->route('products');
        }else{
            \Flash::error('Error: new product not created!');
            return redirect()->route('products.create')->withInput($request->all());
        }
    }

    public function edit($id, EditProductRequest $request)
    {
        $product = Product::updateById($id, $request);
        if($product){
            \Flash::success('Product save!');
            return redirect()->route('products');
        }else{
            \Flash::error('Error: Product not saved!');
            return redirect()->route('products.edit',['id' => $id]);
        }
    }

    public function delete($id)
    {
        if(!\Auth::user()->can('delete.product'))
            return $this->noAccess('Not enough rights to delete');

        if(Product::deleteById($id)){
            \Flash::success('Successfully deleted!');
            return redirect()->route('products');
        }else{
            \Flash::error('Could not delete');
            return redirect()->route('products',['id' => $id]);
        }

    }
}
