<?php

namespace App\Filament\Resources\Carts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class CartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('product_id')
                    ->numeric(),
                Toggle::make('is_active')
                    ->default(true)
            ]);
    }
}
