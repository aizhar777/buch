<?php

namespace App\Modules\Category\Http\Controllers;

use App\Category;
use App\Classes;
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
        return view('category::show');
    }

    public function viewOne($id)
    {
        return view('category::show_one');
    }

    public function create()
    {
        $cats = Category::all()->toHierarchy();
        $types = Classes::all();
        return view('category::create',[
            'types' => $types,
            'cats' => $cats
        ]);
    }

    public function edit($id)
    {
        return view('category::edit');
    }
}
