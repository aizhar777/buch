<?php

namespace App\Modules\Clients\Http\Controllers;

use App\Client;
use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
use App\Modules\Clients\Http\Requests\EditClientAndRequisiteRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function create(CreateClientAndRequisiteRequest $request)
    {

        $client = Client::createClientAndRequisite($request);

        if ($client instanceof Client){
            \Flash::success('New Client created!');
            return redirect()->route('clients');
        }else{
            \Flash::error('Error: new Client not created!');
            return redirect()->route('clients.create')->withInput($request->all());
        }
    }

    public function edit($id, EditClientAndRequisiteRequest $request)
    {
        $client = Client::editClientAndRequisite($id, $request);

        if ($client instanceof Client){
            \Flash::success('Client Updated!');
            return redirect()->route('clients');
        }else{
            \Flash::error('Error: Client not Updated!');
            return redirect()->route('clients.edit',['id' => $id])->withInput($request->all());
        }

    }

    public function delete($id)
    {
        if(!\Auth::user()->can('delete.client'))
            return $this->noAccess('Not enough rights to delete');

        $client = Client::deleteClientById($id);

        if($client){
            \Flash::success('Successfully deleted!');
            return redirect()->route('clients');
        }else{
            \Flash::error('Could not delete');
            return redirect()->route('clients',['id' => $id]);
        }

    }
}
