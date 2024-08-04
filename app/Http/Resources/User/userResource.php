<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'id' => $this->id,
            'image' => $this->image,
            'token' => $this->token
        ];
    }
}
