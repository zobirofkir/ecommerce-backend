<?php
namespace App\Services\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Constructors\ProductConstructor;

class ProductService implements ProductConstructor
{
    public function index()
    {
        return ProductResource::collection(
            Product::orderBy('id', 'desc')->get()
        );
    }

    public function show(Product $product, $slug)
    {
        $product  = Product::where('slug', $slug)->first();
        return ProductResource::make($product);
    }
}
