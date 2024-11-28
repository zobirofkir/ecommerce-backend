<?php
namespace App\Services\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Constructors\CategoryConstructor;

class CategoryService implements CategoryConstructor
{
    public function index()
    {
        return CategoryResource::collection(
            Category::orderBy('id', 'desc')->get()
        );
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }
}
