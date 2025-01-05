<?php

namespace App\Http\Requests\Api\Chat;

use App\Requests\ApiMasterRequest;

class PrivateRoomRequest extends ApiMasterRequest {


  public function rules() {

    return [
      'memberable_id'   => 'required|numeric',
      'memberable_type' => 'required|in:User,Admin,Provider,Merchant,Delegate',
    ];

  }
}
