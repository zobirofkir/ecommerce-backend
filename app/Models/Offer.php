<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Offer extends Model
{
    protected $fillable = [
        "category_id",
        "user_id",
        "title",
        "images",
        "description",
        "price",
        "slug"
    ];

    protected $casts = [
        "images" => "array"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
