<?php

namespace App\Modules\User\Http\Requests;

use App\User;
use Illuminate\Http\Request;
use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequisiteRequest extends FormRequest
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
            if( $user->id == $request->route('id') || ($this->checkPerm('edit.user') && $this->checkPerm('create.requisite')) )
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
        return [
            'legal_name' => 'required|max:255',
            'bank' => 'required|max:255',
            'iik' => 'required|alpha_num',
            'iin' => 'required|alpha_num',
            'bin' => 'required|alpha_num',
            'cbe' => 'required|numeric',
        ];
    }
}
