<?php

namespace App\Modules\User\Http\Requests;

use App\User;
use Illuminate\Http\Request;
use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRoleRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = $this->getCurrentUser();
        if($user instanceof User) {
            if ($user->id == $request->route('id') || $this->checkPerm('edit.role')){
                return true;
            }
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
        return [
            'roles' => 'required|array|exists:roles,id'
        ];
    }
}
