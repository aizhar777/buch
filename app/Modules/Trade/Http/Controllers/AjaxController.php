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
            return $this->noAccess(trans('trade:module.messages.access_denied'));

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
            $msg = trans('trade::module.messages.unknown_error');
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
                    'title' => trans('trade::module.messages.update'),
                    'message' => trans('trade::module.messages.quantity_updated_successfully'),
                    "data" => []
                ]);
            }else{
                \Flash::success(trans('trade::module.messages.quantity_updated'));
                $result = redirect()->route('trade.show',['id' => $request->get('trade')]);
            }
        }else{
            if($request->ajax()){
                $result = json_encode([
                    'status' => "error",
                    'title' => trans('trade::module.messages.update'),
                    'message' => trans('trade::module.messages.quantity_could_not_update'),
                    "data" => []
                ]);
            }else{
                \Flash::error(trans('trade::module.messages.quantity_could_not_update'));
                $result = redirect()->route('trade.show',['id' => $request->get('trade')]);
            }
        }

        return $result;
    }
}
