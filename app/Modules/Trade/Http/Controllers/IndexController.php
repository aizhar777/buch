<?php

namespace App\Modules\Trade\Http\Controllers;

use App\Client;
use App\Modules\Trade\Http\Requests\CreateTradeRequest;
use App\Ppc;
use App\Product;
use App\Trade;
use App\TradeStatus;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkPerm('view.trade'))
            return $this->noAccess('Not enough rights to view');
        $trades = Trade::all();
        return view('trade::index',['trades' => $trades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPerm('create.trade'))
            return $this->noAccess('Not enough rights to view');

        $products = Product::all();
        $users = User::all();
        $ppc = Ppc::all();
        $status = TradeStatus::all();
        $clients = Client::all();
        return view('trade::create',[
            'products' => $products,
            'users' => $users,
            'codes' => $ppc,
            'clients' => $clients,
            'all_status' => $status,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTradeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTradeRequest $request)
    {
        $tradeCreated = Trade::createTradeAndAddProducts($request);
        if ($tradeCreated instanceof Trade){
            \Flash::success('Trade created!');
            return redirect()->route('trade');
        } else {
            \Flash::error('Trade not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkPerm('show.trade'))
            return $this->noAccess('Not enough rights to view');

        $trade = Trade::whereId($id)
            ->with([
                'statuses',
                'ppCode',
                'client',
                'supervisor',
                'completer',
            ])
            ->firstOrFail();

        $statuses = TradeStatus::all();

        return view('trade::show',['trade' => $trade, 'statuses' => $statuses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
