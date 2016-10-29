<?php

namespace App\Modules\Subdivision\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Library\Traits\CurrentUserModel;

class CreateSubdivisionRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->checkPerm('create.subdivision'))
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
            'responsible' => 'required_with:is_responsible|exists:users,id',
            'address' => '',
        ];
    }
}
