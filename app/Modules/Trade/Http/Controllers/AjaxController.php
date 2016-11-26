<?php

namespace App\Modules\Trade\Http\Controllers;

use App\Modules\Trade\Http\Requests\AddProductsToTradeRequest;
use App\Modules\Trade\Http\Requests\UpdateAmountProductsInTrade;
use App\Trade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AjaxController extends Controller
{
    /**
     * Show Products by Trade ID
     *
     * @param $id
     * @return Response
     */
    public function getProducts($id)
    {
        if(!$this->checkPerm('show.trade'))
            return $this->noAccess('Not enough rights to view');

        $trade = Trade::findByIdWithAllRelations($id);
        return view('trade::ajax.trade_products',['products' => $trade->products, 'trade_id' => $trade->id]);
    }

    /**
     * Add products
     *
     * @param AddProductsToTradeRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProducts(AddProductsToTradeRequest $request)
    {
        $json = [];
        try{
            $trade = Trade::addProducts($request);
            $response = $trade->getProductsAsHtmlTable();
            $data = json_encode($trade->products->toArray());
            $json = [
                'status' => "success",
                'message' => "Added",
                "data" => $data
            ];
        }catch (\Exception $e){
            $msg = "An unknown error occurred, please try again later!";
            if(config('app.debug') == true)
                $msg .= '<p>' . $e->getMessage() .' '. $e->getFile() . ' on line ' . $e->getLine() . '</p>';
            $response = "<div class='alert alert-error'>" . $msg . "</div>";
            $json = [
                'status' => "error",
                'message' => $msg,
                "data" => []
            ];
        }
        if((bool)$request->get('json')){
            return $json;
        }
        return view('trade::ajax.trade_products',['products' => $response]);
    }

    public function updateProductQuantity(UpdateAmountProductsInTrade $request)
    {
        $json = [];
        if(Trade::updateProductQuantity($request)){
            if($request->ajax()){
                $result = json_encode([
                    'status' => "success",
                    'title' => "Update",
                    'message' => "Quantity of successfully updated",
                    "data" => []
                ]);
            }else{
                \Flash::success('Quantity updated');
                $result = redirect()->route('trade.show',['id' => $request->get('trade')]);
            }
        }else{
            if($request->ajax()){
                $result = json_encode([
                    'status' => "error",
                    'title' => "Update",
                    'message' => "Can not update quantity of the product, try again later",
                    "data" => []
                ]);
            }else{
                \Flash::error('Can not update quantity of the product, try again later');
                $result = redirect()->route('trade.show',['id' => $request->get('trade')]);
            }
        }

        return $result;
    }
}
