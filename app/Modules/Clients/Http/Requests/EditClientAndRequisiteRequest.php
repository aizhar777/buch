<?php

namespace App\Modules\Clients\Http\Requests;


use App\Library\Traits\CurrentUserModel;

class EditClientAndRequisiteRequest extends EditClientRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->checkPerm('edit.client'))
            return false;
        if(!$this->checkPerm('edit.requisite'))
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

            # Client
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'curator' => 'exists:users,id',

            # Requisite
            'requisite.legal_name' => 'required',
            'requisite.bank' => 'required',
            'requisite.iik' => 'required|alpha_num',
            'requisite.bin' => 'required|alpha_num',
            'requisite.cbe' => 'required|numeric',
        ];
    }
}
