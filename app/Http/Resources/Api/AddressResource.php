<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'phone'      => $this->phone,
            'address'    => $this->address,
            // 'city'       => new CityResource($this->city),
            'latitude'   => $this->latitude,
            'longitude'  => $this->longitude,
            'is_default' => $this->is_default,
        ];
    }
}
