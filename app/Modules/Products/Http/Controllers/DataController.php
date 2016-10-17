<?php

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Http\Requests\CreateProductRequest;
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

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }
}
