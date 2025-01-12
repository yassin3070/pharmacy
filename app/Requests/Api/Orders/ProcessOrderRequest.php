<?php

namespace App\Requests\Api\Orders;

use App\Requests\ApiMasterRequest;

class ProcessOrderRequest extends ApiMasterRequest
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
            'address_id'                 => 'required|exists:addresses,id,user_id,' . user()?->id,
            'delivery_date'                 => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'items_count' => user()?->cart?->items()?->count(),
        ]);
    }
}
