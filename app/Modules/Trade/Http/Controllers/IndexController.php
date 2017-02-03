<?php

namespace App\Modules\Trade\Http\Controllers;

use App\Client;
use App\Events\TradeCreated;
use App\Modules\Trade\Http\Requests\CreateTradeRequest;
use App\Modules\Trade\Http\Requests\UpdateTradeRequest;
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
     * Display a Trades
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->checkPerm('view.trade'))
            return $this->noAccess(trans('trade::module.messages.not_enough_rights_to_view'));

        $trades = Trade::paginate($this->perPager());
        return view('trade::index', ['trades' => $trades]);
    }

    /**
     * Create trade
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->checkPerm('create.trade'))
            return $this->noAccess(trans('trade::module.messages.not_enough_rights_to_view'));

        $products = Product::all();
        $users = User::all();
        $ppc = Ppc::all();
        $status = TradeStatus::all();
        $clients = Client::all();
        return view('trade::create', [
            'products' => $products,
            'users' => $users,
            'codes' => $ppc,
            'clients' => $clients,
            'all_status' => $status,
        ]);
    }

    /**
     * Store Trade.
     *
     * @param  CreateTradeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTradeRequest $request)
    {
        $tradeCreated = Trade::createTrade($request);
        if ($tradeCreated instanceof Trade) {
            event(new TradeCreated($tradeCreated, $this->getCurrentUser()));
            \Flash::success(trans('trade::module.messages.created_successfully'));
            return redirect()->route('trade');
        } else {
            \Flash::error(trans('trade::module.messages.could_not_create'));
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Show trade
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->checkPerm('show.trade'))
            return $this->noAccess(trans('trade:module.messages.access_denied'));

        $trade = Trade::findByIdWithAllRelations($id);

        $statuses = TradeStatus::all();

        return view('trade::show', ['trade' => $trade, 'statuses' => $statuses]);
    }

    /**
     * Edit trade
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->checkPerm('create.trade'))
            return $this->noAccess(trans('trade::module.messages.not_enough_rights_to_view'));

        $trade = Trade::whereId($id)->with('statuses', 'ppCode', 'client', 'supervisor', 'completer', 'products')->firstOrFail();
        $users = User::all();
        $ppc = Ppc::all();
        $status = TradeStatus::all();
        $clients = Client::all();
        return view('trade::edit', [
            'trade' => $trade,
            'users' => $users,
            'codes' => $ppc,
            'clients' => $clients,
            'all_status' => $status,
        ]);
    }

    /**
     * Update Trade
     *
     * @param  UpdateTradeRequest $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTradeRequest $request, $id)
    {
        $result = Trade::updateTradeandProducts($request, $id);

        if ($result && !is_array($result)) {
            \Flash::success(trans('trade::module.messages.updated_successfully'));
            return redirect()->route('trade.show', ['id' => $id]);
        } else {
            $errors = '<p>' . trans('trade::messages.could_not_update') . '</p>';
            foreach ($result as $err) $errors .= "<p>$err</p>";
            \Flash::error($errors);
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove Trade
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Flash::warning(trans('trade::module.messages.trade_not_delete'));
        return redirect()->back();
    }
}
