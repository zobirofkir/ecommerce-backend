<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->title);
    }

    public function updating(Product $product)
    {
        if ($product->isDirty('title')) {
            $product->slug = Str::slug($product->title);
        }
    }
}
