<?php

namespace App\Modules\User\Http\Requests;

use App\Library\Traits\CurrentUserModel;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRoleRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = $this->getCurrentUser();
        if($user instanceof User){
            if( $user->id == $request->route('id') || $this->checkPerm('edit.role') )
                return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:roles,slug'.$this->findRoleId($request),
        ];
    }

    public function findRoleId(Request $request)
    {
        $patId = '';
        $role = Role::where('slug',$request->get('slug'))->first();
        if($role instanceof Role)
            $patId = ','.$role->id;

        return $patId;
    }
}
