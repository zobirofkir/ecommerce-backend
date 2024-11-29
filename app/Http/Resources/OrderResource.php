<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "url" => $this->url,

            /**
             * Cash on delivery
             */
            "name" => $this->name,
            "email" => $this->email,
            "country" => $this->country,
            "address" => $this->address,
            "postal_code" => $this->postal_code,
        ];
    }
}
