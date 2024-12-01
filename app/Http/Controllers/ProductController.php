<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Facades\ProductFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return ProductFacade::index();
    }


    public function show(Product $product, $slug) : ProductResource
    {
        return ProductFacade::show($product, $slug);
    }

    public function categoryProducts($categorySlug) : AnonymousResourceCollection
    {
        return ProductFacade::categoryProducts($categorySlug);
    }

    public function search(Request $request) : AnonymousResourceCollection
    {
        $query = $request->input('query');
        return ProductFacade::search($query);
    }
}
