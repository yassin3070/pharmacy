<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;

class LoginRequest extends ApiMasterRequest {
 
  public function rules() {

        return [

          'email'        => 'sometimes|email|exists:users,email|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
          'phone'        => 'sometimes|phone_number|exists:users,phone',
          'email_phone'  => 'sometimes',
          'password'     => 'required',
          'device_id'    => 'required|max:250',
          'device_type'  => 'required|in:ios,android,web',
        ];
  }
}
