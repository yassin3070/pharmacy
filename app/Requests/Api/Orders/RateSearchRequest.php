<?php

namespace App\Requests\Api\Orders;

use App\Requests\ApiMasterRequest;

class RateSearchRequest extends ApiMasterRequest
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
            'product_id'   => 'required|exists:products,id',
        ];
    }
}
