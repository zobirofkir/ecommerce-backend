<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "title" => $this->title,
            "image" => is_array($this->image)
                        ? asset('storage/' . $this->image[0])
                        : asset('storage/' . $this->image),
            "description" => $this->description,
            "slug" => $this->slug
        ];
    }
}
