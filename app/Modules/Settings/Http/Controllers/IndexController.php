<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Count items on page
     *
     * @var integer $countItems
     */
    public $countItems = 50;

    public function view(Request $request)
    {
        if(!$this->checkPerm('view.settings'))
            return $this->noAccess('Not enough rights to view');

        $settings = Setting::paginate($this->perPager());
        return view('settings::show',[
            'settings' => $settings
        ]);
    }

    public function create()
    {
        if(!$this->checkPerm('create.settings'))
            return $this->noAccess('Not enough rights to create');
        return view('settings::create');
    }

    public function edit($id)
    {
        if(!$this->checkPerm('edit.settings'))
            return $this->noAccess('Not enough rights to edit');
        return view('settings::edit');
    }
}
