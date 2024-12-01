<?php
namespace App\Services\Services;

use App\Http\Resources\ProductResource;
use App\Models\Category;
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

    public function categoryProducts($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        if (!$category) {
            abort(404);
        }

        $products = $category->products()->orderBy('id', 'desc')->get();

        return ProductResource::collection($products);
    }

    public function search($query)
    {
        $products = Product::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->get();

        return ProductResource::collection($products);
    }
}
