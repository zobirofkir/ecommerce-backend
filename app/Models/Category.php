<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "image",
        "slug"
    ];

    protected $casts = [
        "image" => "array"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title);
        });

        static::updating(function ($category) {
            if ($category->isDirty('title')) {
                $category->slug = Str::slug($category->title);
            }
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
