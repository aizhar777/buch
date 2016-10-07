<?php

namespace App\Modules\Fields\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO:check permissions
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
            'slug' => 'required|alpha_dash',
            'default_value' => 'required',
            'description' => 'required',
            'accessory_type' => 'required|exists:classes,class',
            'is_many_values' => 'required|boolean',
            'is_required' => 'required|boolean',
        ];
    }
}
