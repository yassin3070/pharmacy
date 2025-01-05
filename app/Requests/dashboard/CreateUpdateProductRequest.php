<?php

namespace App\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateProductRequest extends FormRequest
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

        if($this->getMethod() === 'PUT' || $this->getMethod() ===  'PATCH'){
            return [
                'name.ar'         => 'required|string',
                'name.en'         => 'required|string',
                'desc.ar'         => 'required|string',
                'desc.en'         => 'required|string',
                'image'           => 'nullable',
                // 'order'           => 'required|numeric|unique:table_name,order,'.$this->id,
                'is_active'       => 'required',
                'price'           => 'required|numeric',
                'category_id'     => 'required|exists:categories,id',
                'need_recipe'     => 'nullable',

            ];

        }else{

            return [

                'name.ar'         => 'required|string',
                'name.en'         => 'required|string',
                'desc.ar'         => 'required|string',
                'desc.en'         => 'required|string',
                'image'           => 'required',
                // 'order'           => 'required|numeric|unique:table_name,order',
                'is_active'       => 'required',

            ];
        }
    }
}
