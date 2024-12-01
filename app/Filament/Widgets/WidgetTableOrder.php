<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class WidgetTableOrder extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
            )
            ->columns([
                TextColumn::make('user.name'),
                BadgeColumn::make('status')
                            ->colors([
                                "primary" => OrderStatusEnum::PENDING->value,
                                "warning" => OrderStatusEnum::SHIPPED->value,
                                "success" => OrderStatusEnum::DELIVERED->value,
                                "danger" => OrderStatusEnum::CANCELLED->value
                            ]),
                TextColumn::make('total')->label('Total (MAD)'),
            ])->defaultSort('created_at', 'desc');
    }
}
