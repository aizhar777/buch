<?php

namespace App\Modules\Stock\Http\Controllers;

use App\Modules\Stock\Http\Requests\CreateStockRequest;
use App\Modules\Stock\Http\Requests\UpdateStockRequest;
use App\Stock;
use App\Subdivision;
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
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('view.stock'))
            return $this->noAccess('Not enough rights to view');

        $stocks = Stock::paginate($this->perPager());
        return view('stock::index',[
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('create.stock'))
            return $this->noAccess('Not enough rights to create');

        $subdivisions = Subdivision::all();
        $responsibles = User::all();
        return view('stock::create',[
            'subdivisions' => $subdivisions,
            'responsibles' => $responsibles
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('show.stock'))
            return $this->noAccess('Not enough rights to view');

        $stock = Stock::where('id',$id)->firstOrFail();
        return view('stock::show',['stock' => $stock]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('edit.stock'))
            return $this->noAccess('Not enough rights to esit');

        $stock = Stock::where('id',$id)->firstOrFail();
        $subdivisions = Subdivision::all();
        $responsibles = User::all();
        return view('stock::edit',[
            'storage' => $stock,
            'subdivisions' => $subdivisions,
            'responsibles' => $responsibles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Modules\Stock\Http\Requests\CreateStockRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateStockRequest $request)
    {
        $newStock = Stock::createNewStorage($request->all());

        if($newStock instanceof Stock){
            \Flash::success('New storage created!');
            return redirect()->route('stock.show',['id' => $newStock->id]);
        } else {
            \Flash::error('New storage not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Stock\Http\Requests\UpdateStockRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStockRequest $request, $id)
    {
        $stock = Stock::updateStorage($id, $request->all());

        if($stock instanceof Stock){
            \Flash::success('Storage ' . $stock->name . ' updated!');
            return redirect()->route('stock.show',['id' => $stock->id]);
        } else {
            \Flash::error('Storage not updated!');
            return redirect()->route('stock.show',['id' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('delete.stock'))
            return $this->noAccess('Not enough rights to delete');

        if(Stock::all()->count() <= 1){
            \Flash::warning('You can not delete the last storage!');
            return redirect()->back();
        }

        $stock = Stock::where('id',$id)->firstOrFail();
        if($stock->delete()){
            \Flash::success('Storage Deleted!');
            return redirect()->route('stock');
        } else {
            \Flash::error('Storage not deleted!');
            return redirect()->route('stock');
        }
    }
}






























