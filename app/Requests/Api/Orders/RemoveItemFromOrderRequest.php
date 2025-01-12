<?php

namespace App\Requests\Api\Orders;

use App\Models\OrderItem;
use App\Requests\ApiMasterRequest;
use Illuminate\Validation\Rule;

class RemoveItemFromOrderRequest extends ApiMasterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'order_id' => [
                'required',
                Rule::exists('orders', 'id')->where('user_id', user()->id),
            ],
            'order_item_id' => [
                'required',
            ],
        ];
    }
}
