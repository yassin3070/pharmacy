<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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

            'id'    => $this->id,
            'name'  => $this->name,
            'desc'  => $this->desc,
            'image' => $this->image,
            'parent_category'    => new CategoryResource($this->parent)
        ];
    }
}
