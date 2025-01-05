<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;


class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        $userId = $this->user()->id;

        return [
            'first_name'  => 'sometimes|max:255',
            'last_name'   => 'sometimes|max:255',
            'phone'       => [
                'sometimes',
                'phone_number',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
            'image'       => 'sometimes|image',
            'device_id'   => 'required|max:250',
            'device_type' => 'required|in:ios,android,web',
        ];
    }
}
