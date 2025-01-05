<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;

class LoginWithoutPasswordRequest extends ApiMasterRequest {


  public function rules() {

        return [

        'email_phone'  => 'required',
        'code'         => 'required',
        'device_id'    => 'required|max:250',
        'device_type'  => 'required|in:ios,android,web',
        
        ];
  }
}
