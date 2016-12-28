<?php

namespace App\Modules\User\Http\Requests;

use App\Http\Requests\Request;
use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->checkPerm('create.role'))
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
            'slug' => 'required|alpha_dash|unique:roles,slug',
            'create_has_role' => 'sometimes|required|accepted',
            'has_role' => 'required_with:create_has_role|exists:roles,slug',
            //
        ];
    }
}
