<?php

namespace App\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateSocialRequest extends FormRequest
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

        if ($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH') {
            return [
                'name.ar'   => 'required|string',
                'name.en'   => 'required|string',
                'image'     => 'nullable',
                'link'      => 'required|url',
                'is_active' => 'required',

            ];

        } else {

            return [

                'name.ar'   => 'required|string',
                'name.en'   => 'required|string',
                'image'     => 'required',
                'link'      => 'required|url',
                'is_active' => 'required',

            ];
        }
    }
}
