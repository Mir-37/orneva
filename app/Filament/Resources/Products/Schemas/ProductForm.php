<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Form;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('image')
                                    ->disk('products')
                                    ->image()
                                    ->imageEditor()
                                    ->required()
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->createOptionForm(fn(Schema $schema) => CategoryForm::configure($schema))
                                    ->editOptionForm(fn(Schema $schema) => CategoryForm::configure($schema)),
                                Select::make('brand_id  ')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm(fn(Schema $schema) => CategoryForm::configure($schema))
                                    ->editOptionForm(fn(Schema $schema) => CategoryForm::configure($schema)),
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
                                // Select::make('rated_by')
                                //     ->options(),
                                // TextInput::make('extras'),
                            ])
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->default(true)
                    ])

            ]);
    }
}
