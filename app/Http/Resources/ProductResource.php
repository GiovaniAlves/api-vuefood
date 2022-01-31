<?php

namespace App\Http\Resources;

use http\Url;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'identify' => $this->uuid,
            'url' => $this->flag,
            'title' => $this->title,
            'image' => $this->image ? Url("storage/{$this->image}") : '',
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}
