<?php

namespace App\Modules\Category\Http\Controllers;

use App\Category;
use App\Modules\Category\Http\Requests\CreateCategoryRequest;
use App\Modules\Category\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function create(CreateCategoryRequest $request)
    {
        $category = Category::createCategory($request);
        if ($category instanceof Category) {
            \Flash::success('New category created!');
            return redirect()->route('category');
        } else {
            \Flash::error('New category not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    public function edit($id, EditCategoryRequest $request)
    {
        $cat = Category::whereId($id)->firstOrFail();
        if ($cat->name != $request->get('name'))
            $cat->name = $request->get('name');
        if ($cat->description != $request->get('description'))
            $cat->description = $request->get('description');

        if ($cat->save()) {
            \Flash::success('Category saved!');
            return redirect()->route('category',['id' => $id]);
        } else {
            \Flash::error('Category not saved!');
            return redirect()->back()->withInput($request->all());
        }
    }

    public function delete($id)
    {
        if(!\Auth::user()->can('delete.category'))
            return $this->noAccess('Not enough rights to delete');

        if (Category::deleteCategory($id)){
            \Flash::success('Category deleted!');
            return redirect()->route('category');
        } else {
            \Flash::error('Category not deleted!');
            return redirect()->back();
        }
    }
}
