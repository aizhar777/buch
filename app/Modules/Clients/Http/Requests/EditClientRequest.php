<?php

namespace App\Modules\Clients\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Library\Traits\CurrentUserModel;

class EditClientRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->getCurrentUser();
        if(!$this->checkPerm('edit.client'))
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
        ];
    }
}
