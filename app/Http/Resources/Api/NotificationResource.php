<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data  = $this->data;
        $title = "title_".App::getLocale();
        $body  = "body_" .App::getLocale();
        return [
            'id'                =>    (string)    $this['id'],
            'type'              =>    (string)    $data['type'],
            'title'             =>    (string)    $data[$title]   ,
            'body'              =>    (string)    $data[$body]   ,
            'data'              =>    array_key_exists('data', $data) ?  $data['data'] : '',
            'status'            =>    $data['status'] ?? '',
            'time'              =>    (string)    $this->created_at->diffForHumans()
        ];
    }
}
