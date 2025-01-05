<?php

namespace App\Requests\Api\Auth;

use App\Requests\ApiMasterRequest;
use Illuminate\Http\Request;

class ApproveRequest extends ApiMasterRequest {
 
  public function rules() {

        return [

            'phone'        => 'required|exists:users,phone'
        ];
  }
}
?>