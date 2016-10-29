<?php

namespace App\Modules\Trade\Http\Controllers;

use App\Trade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function getProducts($id)
    {
        if(!$this->checkPerm('show.trade'))
            return $this->noAccess('Not enough rights to view');

        $trade = Trade::whereId($id)->firstOrFail();
        return view('trade::ajax.trade_products',['products' => $trade->getProductsAsHtmlTable()]);
    }
}
