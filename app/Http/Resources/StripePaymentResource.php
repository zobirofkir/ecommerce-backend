<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StripePaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->user->name ?? null,
            "total" => $this->total,
            "status" => $this->status,
            "url" => $this->url,
            "products" => isset($this->products) ? ProductResource::collection($this->products) : null,
            "created_at" => $this->created_at,
        ];
    }
}
