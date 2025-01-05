<?php

namespace App\Requests\Api;

use App\Requests\ApiMasterRequest;

class ContactRequest extends ApiMasterRequest
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

           'name' => 'required|string|max:255',
           // 'country_code' => 'required|string|max:5',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/',
            'message' => 'required|string|max:500',
        ];
    }
}