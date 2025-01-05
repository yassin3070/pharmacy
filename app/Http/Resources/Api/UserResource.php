<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $token               = '';

    public function setToken($value) {
      $this->token = $value;
      return $this;
    }
  
    public function toArray($request) {
      return [
        'id'                      => $this->id,
        'name'              => $this->name,
        'first_name'              => $this->first_name,
        'last_name'               => $this->last_name,
        'email'                   => $this->email,
        'phone'                   => $this->phone,
        'image'                   => $this->image,
        'lang'                    => $this->lang,
        'is_notify'               => $this->is_notify,
        'token'                   => $this->token,
        'is_phone_verified'       => $this->is_phone_verified ? true : false,
        'is_email_verified'       => $this->is_email_verified ? true : false,
        'user_type'           => new UserTypeResource($this->userType),
      ];
    }
}
