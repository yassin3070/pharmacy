<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;

class ActivateByGeneralRequest extends ApiMasterRequest {
 
  public function rules() {

        return [

            'code'               => 'required|max:10',
            'email_phone'        => 'required',
            'verfiy_token'       => 'required',
            'device_id'          => 'required|max:250',
            'device_type'        => 'required|in:ios,android,web',
            'forget_pass'        => 'nullable|in:0,1'
        ];
  }
}
?>