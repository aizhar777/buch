<?php

namespace App\Modules\User\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Library\Traits\CurrentUserModel;

class EditUserRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = $this->getCurrentUser();
        if($user instanceof User){
            if($user->id == $request->route('id') || $this->checkPerm('edit.user'))
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
        $user = $this->getCurrentUser();
        $pattern = 'required|email|unique:users,email';

        if($this->userModel instanceof User){
            $pattern .= ','.$user->id;
        }

        return [
            'name' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u',
            ],
            'surname' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u',
            ],
            'patronymic' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u',
            ],
            'email:'.$pattern,
            'user_image' => 'sometimes|image|max:8192',
        ];
    }
}
