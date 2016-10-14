<?php

namespace App\Modules\Clients\Http\Requests;


class EditClientAndRequisiteRequest extends EditClientRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        if(!$user->can('edit.client'))
            return false;
        if(!$user->can('edit.requisite'))
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