<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Facades\ProductFacade;

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
}
