<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Facades\CategoryFacade;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryFacade::index();
    }

    public function show(Category $category)
    {
        return CategoryFacade::show($category);
    }
}
