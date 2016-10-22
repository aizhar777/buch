<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function view()
    {
        if(!\Auth::user()->can('view.settings'))
            return $this->noAccess('Not enough rights to view');
        $settings = Setting::all();
        return view('settings::show',[
            'settings' => $settings
        ]);
    }

    public function create()
    {
        if(!\Auth::user()->can('create.settings'))
            return $this->noAccess('Not enough rights to create');
        return view('settings::create');
    }

    public function edit($id)
    {
        if(!\Auth::user()->can('edit.settings'))
            return $this->noAccess('Not enough rights to edit');
        return view('settings::edit');
    }
}
