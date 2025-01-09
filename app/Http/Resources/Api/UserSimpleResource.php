<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSimpleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'image'     => $this->image,
            'lang'      => $this->lang,
            'user_type' => new UserTypeResource($this->userType),
        ];
    }
}
