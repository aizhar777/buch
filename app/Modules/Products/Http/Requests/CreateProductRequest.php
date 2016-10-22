<?php

namespace App\Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!\Auth::user()->can('create.product'))
            return false;
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
            'description' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'is_service' => 'required|boolean',
            'balance' => 'required|integer|min:0',
            'stock' => 'required|exists:categories,id',
            'subdivision' => 'required|exists:subdivisions,id',
        ];
    }
}
