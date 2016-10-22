<?php

namespace App\Modules\Products\Http\Controllers;

use App\Category;
use App\Product;
use App\Stock;
use App\Subdivision;
use Illuminate\Http\Request;

use App\Http\Requests;
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
        if(!\Auth::user()->can('view.product'))
            return $this->noAccess('Not enough rights to view');

        $products = Product::all()->take(10);
        return view('products::show',[
            'products' => $products,
        ]);
    }

    public function viewOne($id)
    {
        if(!\Auth::user()->can('show.product'))
            return $this->noAccess('Not enough rights to view');

        $product = Product::where('id', $id)->firstOrFail();
        return view('products::show_one',[
            'product' => $product
        ]);
    }

    public function create()
    {
        if(!\Auth::user()->can('create.product'))
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
        if(!\Auth::user()->can('edit.product'))
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
