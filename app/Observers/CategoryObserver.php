<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->title);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updating(Category $category)
    {
        if ($category->isDirty('title')) {
            $category->slug = Str::slug($category->title);
        }
    }
}
