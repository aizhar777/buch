<?php

namespace App\Modules\Fields\Http\Controllers;

use App\Classes;
use App\Field;
use App\FieldParam;
use App\Library\Traits\NoAccess;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use NoAccess;

    public function show()
    {
        if(!$this->checkPerm('view.fieldParam'))
            return $this->noAccess('Insufficient permissions to view');
        $this->perPager();
        $felds = FieldParam::paginate($this->countItems);
        return view('fields::show',[
            'fields' => $felds,
        ]);
    }

    public function add()
    {
        if(!$this->checkPerm('create.fieldParam'))
            return $this->noAccess('Insufficient rights to create');

        $types = Classes::all();
        return view('fields::add',['types' => $types]);
    }

    public function edit($id)
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('edit.fieldParam'))
            return $this->noAccess('Insufficient permission to change');

        $field = FieldParam::find($id)->firstOrFail();
        $types = Classes::all();
        return view('fields::edit',['types' => $types, 'field' => $field]);
    }
}
