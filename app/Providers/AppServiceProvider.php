<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\OfferObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Offer::observe(OfferObserver::class);
    }
}
