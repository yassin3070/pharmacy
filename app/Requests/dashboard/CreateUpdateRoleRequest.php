<?php

namespace App\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateRoleRequest extends FormRequest
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
                
                'nickname_ar'         => 'required|string|max:191|unique:roles,nickname_ar,' . $this->id,
                'nickname_en'         => 'required|string|max:191|unique:roles,nickname_en,' . $this->id,
                'permissions'         => 'required|array',
                'name'                => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:roles,name,' . $this->id,


            ];
        }else{
            
            return [
            
                'nickname_ar'         => 'required|string|max:191|unique:roles,nickname_ar',
                'nickname_en'         => 'required|string|max:191|unique:roles,nickname_en',
                'permissions'         => 'required|array',
                'name'                => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:roles,name',
    
    
            ];
        }
    }
}
