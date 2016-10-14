<?php

namespace App\Modules\Clients\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use App\Library\BFields;
use App\User;

class IndexController extends Controller
{
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

    public function viewAll()
    {
        if(!\Auth::user()->can('view.clients'))
            return $this->noAccess('Insufficient permissions to view');

        $clients = Client::all()->take(40);

        return view('clients::show',[
            'clients' => $clients
        ]);
    }

    public function viewOne($id)
    {
        if(!\Auth::user()->can('view.client'))
            return $this->noAccess('Insufficient permissions to view');

        $client = Client::find($id)->firstOrFail();
        $fields = BFields::getInstance()->all($client->id,$client::TYPE);

        return view('clients::showClient',[
            'client' => $client,
            'fields' => $fields
        ]);
    }

    public function create()
    {
        if(!\Auth::user()->can('create.client'))
            return $this->noAccess('Insufficient permissions to view');

        $users = User::all();
        return view('clients::create',['curators' => $users]);
    }

    public function edit($id)
    {
        if(!\Auth::user()->can('edit.client'))
            return $this->noAccess('Insufficient permissions to view');

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
