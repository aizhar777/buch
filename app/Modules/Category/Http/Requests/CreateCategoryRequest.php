<?php

namespace App\Modules\Category\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Todo: check permissions
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'required_with:subcategory|exists:categories,id',
            'description' => '',
            'cat_type' => 'required|exists:classes,class',
        ];
    }
}
