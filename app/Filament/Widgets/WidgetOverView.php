<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WidgetOverView extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Orders', Order::count())
                ->description('Orders')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->chart([1, 10, 5, 2, 20, 30, 45])
                ->color('success'),

            Stat::make('Products', Product::count())
                ->description('Products')
                ->descriptionIcon('heroicon-o-cube')
                ->chart([1, 10, 5, 2, 20, 30, 45])
                ->color('success'),

            Stat::make('Categories', Category::count())
                ->description('Categories')
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->chart([1, 10, 5, 2, 20, 30, 45])
                ->color('success'),

            Stat::make('Offers', Offer::count())
                ->description('Offers')
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->chart([1, 10, 5, 2, 20, 30, 45])
                ->color('success'),
            ];
    }
}
