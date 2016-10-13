<?php

namespace App\Modules\Clients\Http\Controllers;

use App\Client;
use App\Modules\Clients\Http\Requests\CreateClientAndRequisiteRequest;
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
            \Flash::success('Error: new Client not created!');
            return redirect()->route('clients.create')->withInput($request->all());
        }
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }
}
