<?php

namespace App\Modules\Fields\Http\Controllers;

use App\Field;
use App\FieldParam;
use App\Modules\Fields\Http\Requests\CreateFieldRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function create(CreateFieldRequest $request)
    {
        //TODO:check permissions
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
}
