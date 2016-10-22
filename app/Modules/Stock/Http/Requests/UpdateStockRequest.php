<?php

namespace App\Modules\Stock\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!\Auth::user()->can('edit.stock'))
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
            'slug' => 'required|alpha_dash',
            'description' => '',
            'subdivision_id' => 'required|exists:subdivisions,id',
            'responsible' => 'required_with:is_responsible|exists:users,id',
            'address' => '',
        ];
    }
}
