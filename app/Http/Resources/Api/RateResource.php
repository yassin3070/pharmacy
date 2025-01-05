<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'id'       => $this->id,
            'rate'     => $this->rate,
            'comment'  => $this->comment,
            'user'     => new UserSimpleResource($this->user),
            'order_id' => $this->order_id,
        ];
    }
}
