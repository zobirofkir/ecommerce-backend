<?php
namespace App\Services\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Constructors\CategoryConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService implements CategoryConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return CategoryResource::collection(
            Category::orderBy('id', 'desc')->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @return CategoryResource
     */
    public function show(Category $category) : CategoryResource
    {
        return CategoryResource::make($category);
    }
}
