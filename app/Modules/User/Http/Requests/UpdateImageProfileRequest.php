<?php

namespace App\Modules\User\Http\Requests;

use App\Http\Requests\Request;
use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImageProfileRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->checkPerm('edit.user'))
            return true;
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
            'image' => 'required|exists:images,id'
        ];
    }
}
