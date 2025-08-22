<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('delivery_address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
