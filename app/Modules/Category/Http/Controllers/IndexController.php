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
            return $this->index();
        return $this->show($id);
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        if(!$user->can('view.category'))
            return $this->noAccess('Not enough rights to view');

        $cats = Category::all();
        return view('category::show',[
            'categories' => $cats
        ]);
    }

    public function show($id)
    {
        $user = $this->getCurrentUser();
        if(!$user->can('show.category'))
            return $this->noAccess('Not enough rights to show');

        $cat = Category::whereId($id)->firstOrFail();
        return view('category::show_one',[
            'category' => $cat
        ]);
    }

    public function create()
    {
        $user = $this->getCurrentUser();
        if(!$user->can('create.category'))
            return $this->noAccess('Not enough rights to create');

        $cats = Category::all()->toHierarchy();
        $types = Classes::all();
        return view('category::create',[
            'types' => $types,
            'cats' => $cats
        ]);
    }

    public function edit($id)
    {
        $user = $this->getCurrentUser();
        if(!$user->can('edit.category'))
            return $this->noAccess('Not enough rights to delete');

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
