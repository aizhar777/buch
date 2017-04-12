<?php

namespace App\Modules\Clients\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use App\Library\BFields;
use App\User;

class IndexController extends Controller
{
    /**
     * Index page action
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    public function view($id = null)
    {
        $view = null;

        if($id !== null){
            $view = $this->viewOne($id);
        }else{
            $view = $this->viewAll();
        }

        return $view;
    }

    /**
     * Show All Clients
     *
     * @return \Illuminate\View\View
     */
    public function viewAll()
    {
        if(!$this->checkPerm('view.client'))
            return $this->noAccess( trans('modules.messages.not_enough_rights_to_view') );

        $this->perPager();
        $clients = Client::with('requisites', 'supervise')->paginate($this->countItems);

        return view('clients::show',[
            'clients' => $clients
        ]);
    }

    /**
     * Show One Client
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function viewOne($id)
    {
        if(!$this->checkPerm('show.client'))
            return $this->noAccess( trans('modules.messages.not_enough_rights_to_view') );

        $client = Client::whereId($id)->firstOrFail();
        $fields = BFields::getInstance()->all($client->id,$client::TYPE);

        return view('clients::showClient',[
            'client' => $client,
            'fields' => $fields
        ]);
    }

    /**
     * Create client Action
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(!$this->checkPerm('create.client'))
            return $this->noAccess( trans('modules.messages.not_enough_rights_to_view') );

        $users = User::all();
        return view('clients::create',['curators' => $users]);
    }

    /**
     * Edit client action
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(!$this->checkPerm('edit.client'))
            return $this->noAccess( trans('modules.messages.not_enough_rights_to_view') );

        $client = Client::find($id)->firstOrFail();
        $users = User::all();
        $fields = BFields::getInstance()->all($client->id,$client::TYPE);
        $requisite = $client->requisites;

        return view('clients::edit',[
            'client' => $client,
            'requisite' => $requisite,
            'fields' => $fields,
            'curators' => $users
        ]);
    }

}
