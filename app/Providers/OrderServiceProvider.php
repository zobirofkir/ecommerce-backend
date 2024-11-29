<?php

namespace App\Providers;

use App\Services\Services\OrderService;
use App\Services\Services\Payments\StripePaymentService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("OrderService", function ($app) {
            return new OrderService(
                $app->make(StripePaymentService::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
