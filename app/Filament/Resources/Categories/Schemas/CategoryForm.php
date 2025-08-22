<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema(
                        [
                            Grid::make(2)
                                ->columns(2)
                                ->columnSpanFull()
                                ->schema([
                                    TextInput::make('name')
                                        ->required(),
                                    TextInput::make('slug'),
                                    Toggle::make('is_active')
                                        ->default(true)
                                ])
                                ->columns(2)
                                ->columnSpanFull()

                        ]
                    )
                    ->columnSpanFull()


            ]);
    }
}
