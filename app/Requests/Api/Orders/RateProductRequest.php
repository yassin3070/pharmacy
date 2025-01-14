<?php

namespace App\Requests\Api\Orders;

use App\Requests\ApiMasterRequest;

class RateProductRequest extends ApiMasterRequest
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
//            'user_id'   => 'required|exists:users,id',
            'rate'      => 'required|integer|min:1|max:5',
            'comment'   => 'nullable|string|max:255',
            'product_id'  => 'required_without:order_id|exists:products,id',
            'order_id'    => 'required_without:product_id|exists:orders,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => user()->id,
        ]);
    }
}
