<?php

namespace App\Modules\User\Http\Requests;

use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    use CurrentUserModel;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->checkPerm('create.user'))
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'patronymic' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'roles' => 'required|exists:roles,id',
            'password' => 'required|min:6|confirmed'
        ];
    }
}
