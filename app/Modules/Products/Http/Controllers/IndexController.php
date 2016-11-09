<?php

namespace App\Modules\Products\Http\Controllers;

use App\Product;
use App\Stock;
use App\Subdivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function view($id = null)
    {
        if($id === null)
            return $this->viewAll();
        return $this->viewOne($id);
    }

    public function viewAll()
    {
        if(!$this->checkPerm('view.product'))
            return $this->noAccess('Not enough rights to view');

        $products = Product::with('stock', 'subdivision')->paginate($this->perPager());
        return view('products::show',[
            'products' => $products,
        ]);
    }

    public function viewOne($id)
    {
        if(!$this->checkPerm('show.product'))
            return $this->noAccess('Not enough rights to view');

        $product = Product::where('id', $id)->firstOrFail();
        return view('products::show_one',[
            'product' => $product
        ]);
    }

    public function create()
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('create.product'))
            return $this->noAccess('Not enough rights to delete');

        $stocks = Stock::all();
        $subs = Subdivision::all();
        return view('products::create',[
            'stocks' => $stocks,
            'subdivisions' => $subs,
        ]);
    }

    public function edit($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('edit.product'))
            return $this->noAccess('Not enough rights to delete');

        $product = Product::where('id', $id)->firstOrFail();
        $stocks = Stock::all();
        $subs = Subdivision::all();
        return view('products::edit',[
            'product' => $product,
            'stocks' => $stocks,
            'subdivisions' => $subs,
        ]);
    }
}
