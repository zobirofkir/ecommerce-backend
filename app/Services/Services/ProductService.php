<?php
namespace App\Services\Services;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\Constructors\ProductConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService implements ProductConstructor
{
    /**
     * Get all products
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::orderBy('id', 'desc')->get()
        );
    }

    /**
     * Get single product
     *
     * @param Product $product
     * @param $slug
     * @return ProductResource
     */
    public function show(Product $product, $slug) : ProductResource
    {
        $product  = Product::where('slug', $slug)->first();
        return ProductResource::make($product);
    }

    /**
     * Get products by category
     *
     * @param $categorySlug
     * @return AnonymousResourceCollection
     */
    public function categoryProducts($categorySlug) : AnonymousResourceCollection
    {
        $category = Category::where('slug', $categorySlug)->first();

        if (!$category) {
            abort(404);
        }

        $products = $category->products()->orderBy('id', 'desc')->get();

        return ProductResource::collection($products);
    }

    /**
     * Search products
     *
     * @param $query
     * @return AnonymousResourceCollection
     */
    public function search($query) : AnonymousResourceCollection
    {
        $products = Product::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->get();

        return ProductResource::collection($products);
    }
}
