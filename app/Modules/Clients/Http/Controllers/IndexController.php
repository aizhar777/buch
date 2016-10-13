<?php

namespace App\Modules\Clients\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use App\User;

class IndexController extends Controller
{
    public function view($id = null)
    {
        if(!\Auth::user()->can('view.client'))
            return $this->noAccess('Insufficient permissions to view');

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
        $clients = Client::all()->take(40);

        return view('clients::show',[
            'clients' => $clients
        ]);
    }

    public function viewOne($id)
    {
        $client = Client::find($id)->firstOrFail();

        return view('clients::showClient',[
            'client' => $client
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('clients::create',['curators' => $users]);
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }
}
