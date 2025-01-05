<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;

class SendOtpRequest extends ApiMasterRequest {
 
  public function rules() {

        return [

          'email_phone'  => 'required',
          'forget_pass'  => 'nullable|in:0,1'
       
        ];
  }
}



?>
