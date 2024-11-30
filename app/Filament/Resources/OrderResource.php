<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatusEnum;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Order Status')
                    ->options(
                        collect(OrderStatusEnum::cases())
                            ->mapWithKeys(fn ($enum) => [$enum->value => $enum->label()])
                            ->toArray()
                    )
                    ->required()
                    ->default(OrderStatusEnum::PENDING->value),
                Hidden::make('user_id')->default(Auth::id())
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable(),

                TextColumn::make('total')
                    ->label('Total')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Order Status')
                    ->getStateUsing(fn ($record) => OrderStatusEnum::from($record->status)->label())
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Order Status')
                    ->options(
                        collect(OrderStatusEnum::cases())
                            ->mapWithKeys(fn ($enum) => [$enum->value => $enum->label()])
                            ->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
