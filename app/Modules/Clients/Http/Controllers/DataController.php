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
    /**
     * Create client
     *
     * @param CreateClientAndRequisiteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateClientAndRequisiteRequest $request)
    {
        $client = Client::createClientAndRequisite($request);

        if ($client instanceof Client){
            \Flash::success( trans('clients::module.messages.created_successfully') );
            return redirect()->route('clients');
        }else{
            \Flash::error( trans('clients::module.messages.could_not_create') );
            return redirect()->route('clients.create')->withInput($request->all());
        }
    }

    /**
     * Edit client
     *
     * @param $id
     * @param EditClientAndRequisiteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id, EditClientAndRequisiteRequest $request)
    {
        $client = Client::editClientAndRequisite($id, $request);

        if ($client instanceof Client){
            \Flash::success( trans('clients::module.messages.updated_successfully') );
            return redirect()->route('clients');
        }else{
            \Flash::error( trans('clients::module.messages.could_not_update') );
            return redirect()->route('clients.edit',['id' => $id])->withInput($request->all());
        }

    }

    /**
     * Delete client
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if(!$this->checkPerm('delete.client'))
            return $this->noAccess( trans('modules.access_denied') );

        $client = Client::deleteClientById($id);

        if($client){
            \Flash::success( trans('clients::module.messages.deleted_successfully') );
            return redirect()->route('clients');
        }else{
            \Flash::error( trans('clients::module.messages.could_not_delete') );
            return redirect()->route('clients',['id' => $id]);
        }

    }
}
