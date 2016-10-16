<?php

namespace App\Modules\Products\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function view($id = null)
    {
        if($id === null)
            return $this->viewAll();
        return $this->viewOne($id);
    }

    public function viewAll()
    {
        return 'ALL Products';
    }

    public function viewOne($id)
    {
        return 'One Product';
    }

    public function create()
    {
        return 'Create Product';
    }

    public function edit($id)
    {
        return 'Edit Product';
    }
}
