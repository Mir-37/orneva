<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('order_no')
                                    ->required()
                                    ->placeholder('ORD-123458')
                                    ->unique('orders', 'order_no', ignoreRecord: true),
                                Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required(),
                                TextInput::make('total_amount')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                Textarea::make('delivery_address')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('status')
                                    ->options([
                                        'pending'    => 'Pending',
                                        'processing' => 'Processing',
                                        'returned'   => 'Returned',
                                        'shipped'    => 'Shipped',
                                        'completed'  => 'Completed',
                                        'cancelled'  => 'Cancelled',
                                    ])
                                    ->required()
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                    ])
                    ->columnSpanFull()
            ]);
    }
}
