<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price_before,
            "category" => $this->category->name,
            "size" => $this->size->name,
            "admin" => $this->user->name,
            "quantity" => $this->quantity
        ];
    }
}
