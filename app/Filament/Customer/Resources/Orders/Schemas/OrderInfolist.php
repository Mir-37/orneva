<?php

namespace App\Filament\Customer\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('order_no')
                            ->label('Order #'),

                        // Show the user's name instead of just user_id
                        TextEntry::make('user.name')
                            ->label('Customer'),

                        TextEntry::make('total_amount')
                            ->numeric()
                            ->label('Total Amount'),

                        // Show items as product name x qty, joined with commas
                        TextEntry::make('orderItems')
                            ->label('Items')
                            ->state(function ($record) {
                                return $record->orderItems
                                    ->map(fn($item) => "{$item->product->name} x {$item->quantity}")
                                    ->join(', ');
                            }),



                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('status'),

                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Created At'),

                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->label('Updated At'),
                    ])
            ]);
    }
}
