<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Facades\ProductFacade;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductFacade::index();
    }


    public function show(Product $product, $slug)
    {
        return ProductFacade::show($product, $slug);
    }

    public function categoryProducts($categorySlug)
    {
        return ProductFacade::categoryProducts($categorySlug);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        return ProductFacade::search($query);
    }
}
