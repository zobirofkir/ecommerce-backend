<?php
namespace App\Services\Constructors;

use App\Models\Product;

interface ProductConstructor
{
    public function index();
    public function show(Product $product, $slug);
    public function categoryProducts($categorySlug);
    public function search($query);
}
