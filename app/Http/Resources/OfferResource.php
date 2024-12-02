<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            "user_name" => $this->user->name,
            "category_title" => $this->category->title,
            "title" => $this->title,
            "images" => is_array($this->images)
                        ? implode(', ', array_map(fn($img) => asset('storage/' . $img), $this->images))
                        : asset('storage/' . $this->images),
            "description" => $this->description,
            "price" => $this->price,
            "slug" => $this->slug,
            "created_at" => $this->created_at
        ];
    }
}
