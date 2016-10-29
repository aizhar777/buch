<?php

namespace App\Modules\Fields\Http\Controllers;

use App\Field;
use App\FieldParam;
use App\Library\Traits\NoAccess;
use App\Modules\Fields\Http\Requests\CreateFieldRequest;
use App\Modules\Fields\Http\Requests\EditFieldsMapRequest;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    use NoAccess;

    public function create(CreateFieldRequest $request)
    {
        $createdField = FieldParam::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'default_value' => $request->get('default_value'),
            'description' => $request->get('description'),
            'accessory_type' => $request->get('accessory_type'),
            'is_many_values' => $request->get('is_many_values'),
            'is_required' => $request->get('is_required'),
        ]);

        if ($createdField instanceof FieldParam){
            \Flash::success('Field '.$createdField->name.' is created');
            return redirect()->route('field.list');
        }else{
            \Flash::error('Field '.$createdField->name.' is not created');
            return redirect()->route('field.add');
        }
    }

    public function edit($id, EditFieldsMapRequest $request)
    {
        $fMap = FieldParam::find($id)->firstOrFail();

        if ($fMap->name != $request->get('name'))
            $fMap->name = $request->get('name');

        if ($fMap->slug != $request->get('slug'))
            $fMap->slug = $request->get('slug');

        if ($fMap->default_value != $request->get('default_value'))
            $fMap->default_value = $request->get('default_value');

        if ($fMap->description != $request->get('description'))
            $fMap->description = $request->get('description');

        if ($fMap->accessory_type != $request->get('accessory_type'))
            $fMap->accessory_type = $request->get('accessory_type');

        if ($fMap->is_many_values != $request->get('is_many_values'))
            $fMap->is_many_values = $request->get('is_many_values');

        if ($fMap->is_required != $request->get('is_required'))
            $fMap->is_required = $request->get('is_required');

        if($fMap->save()){
            \Flash::success('Field Settings successfully changed!');
            $redirect = redirect()->route('field.list');
        }else{
            \Flash::error('Changes have not been saved!');
            $redirect = redirect()->route('fields.edit',['id' => $id]);
        }

        return $redirect;
    }

    public function delete($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('delete.fieldParam'))
            return $this->noAccess('Not enough rights to delete');

        $fMap = FieldParam::find($id)->firstOrFail();

        if($fMap->delete()){
            \Flash::success('Successfully deleted!');
            return redirect()->route('field.list');
        }else{
            \Flash::error('Could not delete');
            return redirect()->route('field.list');
        }
    }
}
