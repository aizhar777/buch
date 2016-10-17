<?php

namespace App\Modules\Category\Http\Controllers;

use App\Category;
use App\Modules\Category\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function create(CreateCategoryRequest $request)
    {
        $category = Category::addNewCategory($request);
        if($category instanceof Category){
            \Flash::success('New category created!');
            return redirect()->route('category');
        }else{
            \Flash::error('New category not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {
        $cat = Category::deleteCategory($id);
    }
}
