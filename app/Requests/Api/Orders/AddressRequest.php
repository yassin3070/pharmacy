<?php

namespace App\Requests\Api\Orders;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH') {
            return $this->route('address')->user_id == user()->id;
        }

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
            'name'       => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'user_id'    => 'required|exists:users,id',
            'phone'      => 'nullable|string|max:255',
            'city_id'    => 'nullable|exists:cities,id',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
            'is_default' => 'required|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'    => user()->id,
            'is_default' => $this->boolean('is_default'),
        ]);
    }
}
