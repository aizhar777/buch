<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Modules\Settings\Http\Requests\EditSettingsRequest;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function edit($slug, EditSettingsRequest $request)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('edit.settings'))
            return json_encode(['status' => 'error', 'title' => 'Forbiden', 'message' =>  trans('settings::module.messages.not_enough_rights_to_view') ]);

        $result = [
            'title' => trans('settings::module.messages.oh_no'),
            'message' => trans('settings::module.messages.could_not_update'),
            'status' => 'error'
        ];
        $settings = Setting::where('slug', $slug)->firstOrFail();
        if($settings instanceof Setting){
            if($request->get('value') != $settings->value)
                $settings->value = $request->get('value');
            if($settings->save())
                $result = [
                    'title' => trans('settings::module.messages.update',['name' => $settings->name]),
                    'message' => trans('settings::module.messages.updated'),
                    'status' => 'success'
                ];
        }
        return json_encode($result);
    }
}
