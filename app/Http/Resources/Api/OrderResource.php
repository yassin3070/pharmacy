<?php

namespace App\Http\Resources\Api;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'                     => $this->id,
            'order_num'              => $this->order_num,
            'items'                  => OrderItemResource::collection($this->items),
            'address'                => new AddressResource($this->address),
            'user'                   => new UserSimpleResource($this->user),
            'user_note'              => $this->user_note,
            'status_code'            => $this->status,
            'status_name'            => $this->status_name,
            'total'                  => $this->total,
            'created_at'             => $this->created_at,
        ];
    }
}
