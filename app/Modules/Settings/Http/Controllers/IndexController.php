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
        $settings = Setting::all();
        return view('settings::show',[
            'settings' => $settings
        ]);
    }

    public function create()
    {
        return view('settings::create');
    }

    public function edit($id)
    {
        return view('settings::edit');
    }
}
