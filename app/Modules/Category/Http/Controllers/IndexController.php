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
        $cats = Category::all();
        return view('category::show',[
            'categories' => $cats
        ]);
    }

    public function viewOne($id)
    {
        $cat = Category::whereId($id)->firstOrFail();
        return view('category::show_one',[
            'category' => $cat
        ]);
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
        $cats = Category::all()->toHierarchy();
        $cat = Category::whereId($id)->firstOrFail();
        $types = Classes::all();
        return view('category::edit',[
            'types' => $types,
            'cats' => $cats,
            'category' => $cat
        ]);
    }
}
