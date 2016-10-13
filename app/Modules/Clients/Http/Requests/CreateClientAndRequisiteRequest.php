<?php

namespace App\Modules\Clients\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientAndRequisiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        if(!$user->can('create.client'))
            return false;
        if(!$user->can('create.requisite'))
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
            'legal_name' => 'required',
            'bank' => 'required',
            'iik' => 'required|alpha_num',
            'bin' => 'required|alpha_num',
            'cbe' => 'required|numeric',
        ];
    }
}
