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
        $result = [
            'title' => 'Oh no!',
            'message' => 'Unable to update settings',
            'status' => 'error'
        ];
        $settings = Setting::where('slug', $slug)->firstOrFail();
        if($settings instanceof Setting){
            if($request->get('value') != $settings->value)
                $settings->value = $request->get('value');
            if($settings->save())
                $result = [
                    'title' => 'Settings updated',
                    'message' => $settings->name . ' successfully updated!',
                    'status' => 'success'
                ];
        }
        return json_encode($result);
    }
}
