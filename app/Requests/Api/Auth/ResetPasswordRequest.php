<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class ResetPasswordRequest extends FormRequest {
 
  public function rules() {

        return [
          'email' => 'required_without:phone|email|exists:users,email',
          'phone' => 'required_without:email|exists:users,phone',
          'new_password'              => 'required|max:191|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
          'password_confirmation' => 'required|same:new_password',
          
        ];

        
  }
  public function messages()
    {
        return [
            'email.required_without' => trans('validation.email_or_phone_required'),
            'email.email' => trans('validation.email_invalid'),
            'email.exists' => trans('validation.email_not_found'),
            'phone.required_without' => trans('validation.phone_or_email_required'),
            'phone.exists' => trans('validation.phone_not_found'),
            'new_password.required' => trans('validation.new_password_required'),
            'new_password.min' => trans('validation.new_password_min'),
        ];
    }
}
