<?php

namespace App\Modules\Fields\Http\Controllers;

use App\Classes;
use App\FieldParam;
use App\Library\Traits\NoAccess;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use NoAccess;

    public function show()
    {
        //TODO: check permissions
        $felds = FieldParam::all()->take(10);
        return view('fields::show',[
            'fields' => $felds,
        ]);
    }

    public function add()
    {
        //TODO: check permissions
        $types = Classes::all();
        return view('fields::add',['types' => $types]);
    }
}
