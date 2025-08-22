<?php

namespace App\Filament\Resources\Newsletters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('subscribed_email')
                                    ->email()
                                    ->required(),
                            ])
                            ->columnSpanFull()
                    ])
                    ->columnSpanFull()
            ]);
    }
}
