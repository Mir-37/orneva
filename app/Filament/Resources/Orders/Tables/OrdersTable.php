<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_no')
            ->columns([
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('status')
                    ->icon(fn(string $state): string => match ($state) {
                        'pending'    => 'heroicon-o-clock',
                        'processing' => 'heroicon-o-arrow-path',
                        'returned'   => 'heroicon-o-arrow-uturn-left',
                        'shipped'    => 'heroicon-o-truck',
                        'completed'  => 'heroicon-o-check-circle',
                        'cancelled'  => 'heroicon-o-x-circle',
                        default      => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pending'    => 'warning',
                        'processing' => 'info',
                        'returned'   => 'danger',
                        'shipped'    => 'primary',
                        'completed'  => 'success',
                        'cancelled'  => 'gray',
                        default      => 'secondary',
                    })
                    ->tooltip(fn(string $state): string => ucfirst($state))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
