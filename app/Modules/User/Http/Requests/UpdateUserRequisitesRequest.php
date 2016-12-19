<?php

namespace App\Modules\User\Http\Requests;

use App\Library\Traits\CurrentUserModel;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequisitesRequest extends FormRequest
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
            if( $user->id == $request->route('id') || ($this->checkPerm('edit.user') && $this->checkPerm('update.requisite')) )
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
            'req_id'     => 'required|exists:requisites,id',
            'legal_name' => 'sometimes|required|max:255',
            'bank'       => 'sometimes|required|max:255',
            'iik'        => 'sometimes|required|alpha_num',
            'iin'        => 'sometimes|required|alpha_num',
            'bin'        => 'sometimes|required|alpha_num',
            'cbe'        => 'sometimes|required|numeric',
        ];
    }
}
