<?php
namespace App\Services\Constructors;

use App\Models\Category;

interface CategoryConstructor {
    public function index();
    public function show(Category $category);
}
