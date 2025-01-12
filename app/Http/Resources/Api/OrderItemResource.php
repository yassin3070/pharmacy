<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_num' => $this->order_num,
            'order_id' => $this->order_id,
            'user' => new UserResource($this->user),
            'product' => new ProductResource($this->product),
            'recipe' => $this->recipe,
            'need_recipe' => $this->need_recipe,
            'recipe_status' => $this->recipe_status,
            'price' => $this->price,
            'total' => $this->total,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
