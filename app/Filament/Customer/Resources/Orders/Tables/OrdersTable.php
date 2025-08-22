<?php

namespace App\Filament\Customer\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_no')->label('Order #'),
                TextColumn::make('total_amount')->money('usd')->label('Total'),
                TextColumn::make('orderItems')
                    ->label('Items')
                    ->formatStateUsing(fn($record) => $record->orderItems->map(fn($item) => "{$item->product->name} x {$item->quantity}")->join(', ')),
                TextColumn::make('status')->label('Status'),
                TextColumn::make('created_at')->dateTime()->label('Ordered At'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->defaultSort('created_at', 'desc');;
    }
}
