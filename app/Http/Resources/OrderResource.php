<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'comment' => $this->comment ?? '',
            'client' => $this->client ? new ClientResource($this->client) : '',
            'table' => $this->table ? new TableResource($this->table) : '',
            'products' => ProductResource::collection($this->products)
        ];
    }
}
