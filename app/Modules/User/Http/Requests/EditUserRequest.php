<?php

namespace App\Modules\User\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        if($user instanceof User){
            //TODO:check permissions
            if (!$user->can('edit.user'))
                return false;
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = \Auth::user();
        $pattern = 'required|email|unique:users,email';

        if($this->userModel instanceof User){
            $pattern .= ','.$user->id;
        }

        return [
            'name' => [
                'required',
                'regex:/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u',
            ],
            'email:'.$pattern,
            'user_image' => 'sometimes|image|max:8192',
        ];
    }
}
