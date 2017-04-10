<?php

namespace App\Modules\Products\Http\Controllers;

use App\Client;
use App\Modules\Products\Http\Requests\CreateProductRequest;
use App\Modules\Products\Http\Requests\EditProductRequest;
use App\Product;
use App\Trade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DataController extends Controller
{

    /**
     * Create new product action
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateProductRequest $request)
    {
        $product = Product::createNew($request);
        if($product){
            \Flash::success( trans('products::module.messages.created_successfully') );
            return redirect()->route('products');
        }else{
            \Flash::error( trans('products::module.messages.could_not_create') );
            return redirect()->route('products.create')->withInput($request->all());
        }
    }

    public function edit($id, EditProductRequest $request)
    {
        $product = Product::updateById($id, $request);
        if($product){
            \Flash::success( trans('products::module.messages.updated_successfully') );
            return redirect()->route('products');
        }else{
            \Flash::error( trans('products::module.messages.could_not_update') );
            return redirect()->route('products.edit',['id' => $id]);
        }
    }

    public function delete($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('delete.product'))
            return $this->noAccess( trans('products::module.messages.access_denied') );

        if(Product::deleteById($id)){
            \Flash::success( trans('products::module.messages.deleted_successfully') );
            return redirect()->route('products');
        }else{
            \Flash::error( trans('products::module.messages.could_not_delete') );
            return redirect()->route('products',['id' => $id]);
        }

    }

    public function getProductsForm($id = null)
    {
        //todo: refactor!!!!
        $result = $products = Product::with('stock','subdivision')->get();

        if($id != null){
            $result = [];
            $ids = [];
            $pr_isset = Trade::whereId($id)->firstOrFail()->products;

            foreach ($pr_isset as $pr) $ids[] = $pr->id;

            foreach ($products as $product){
                if(!in_array($product->id, $ids)){
                    $result[] = $product;
                }
            }
        }
        return view('products::ajax.products_form',['products' => $result]);
    }
}
