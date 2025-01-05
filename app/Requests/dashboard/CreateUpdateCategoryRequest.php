<?php

namespace App\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCategoryRequest extends FormRequest
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
            
            'name.ar'         => 'required|string|max:191',
            'name.en'         => 'required|string|max:191',
            'desc.ar'         => 'required|string',
            'desc.en'         => 'required|string',
            'image'           => 'nullable',
            'is_active'       => 'required',
            'parent_id'       => 'nullable',
        ];
    }
}
