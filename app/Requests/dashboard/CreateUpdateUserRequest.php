<?php

namespace App\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateUserRequest extends FormRequest
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
            
            'first_name'            => 'required|string|max:191',
            'last_name'             => 'required|string|max:191',
            'phone'                 => 'required|phone_number|unique:users,phone,'.$this->id,
            'email'                 => 'required|email|unique:users,email,'.$this->id,
            'image'                 => 'nullable',
           // 'role_id'               => 'required|exists:roles,id',
            'password'              => 'nullable|max:191|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password_confirmation' => 'same:password',
        ];

        }else{
            return [
                
                'first_name'           => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|phone_number|unique:users,phone',
                'email'                 => 'required|email|unique:users,email',
                'image'                 => 'nullable',
                //'role_id'               => 'required|exists:roles,id',
                'password'              => 'required|max:191|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
                'password_confirmation' => 'required|same:password',
            ];
        }
    }
}
