<?php

namespace App\Modules\Trade\Http\Requests;

use App\Http\Requests\Request;
use App\Library\Traits\CurrentUserModel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTradeRequest extends FormRequest
{
    use CurrentUserModel;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->checkPerm('edit.trade'))
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
            'status' => 'required|exists:trade_statuses,id',
            'ppc' => 'required|exists:ppc,id',
            'curator' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|exists:products,id',
            'product_options' => 'required|array',
            'payment_is_completed' => 'sometimes|boolean',
            'completed_by_user' => 'sometimes|boolean',
        ];
    }
}
