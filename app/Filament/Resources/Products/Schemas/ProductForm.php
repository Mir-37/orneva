<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('brand_id')
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU'),
                TextInput::make('slug'),
                TextInput::make('description'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('flag'),
                TextInput::make('rating')
                    ->numeric(),
                TextInput::make('rated_by')
                    ->numeric(),
                TextInput::make('extras'),
            ]);
    }
}
