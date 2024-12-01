<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Facades\CategoryFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return CategoryFacade::index();
    }

    /**
     * Display the specified resource.
     *
     * @return CategoryResource
     */
    public function show(Category $category) : CategoryResource
    {
        return CategoryFacade::show($category);
    }
}
