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
        return view('products::show');
    }

    public function viewOne($id)
    {
        return view('products::show_one');
    }

    public function create()
    {
        return view('products::create');
    }

    public function edit($id)
    {
        return view('products::edit');
    }
}
