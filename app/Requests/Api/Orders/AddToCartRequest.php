<?php

namespace App\Requests\Api\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'quantity'                   => 'required|integer|min:1',
            'product_id'                   => 'required|integer|min:1',

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'                    => user()->id,
            'status'                     => Order::STATUSES['in_cart'],
        ]);
    }
}
