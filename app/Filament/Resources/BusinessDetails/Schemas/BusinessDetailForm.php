<?php

namespace App\Filament\Resources\BusinessDetails\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BusinessDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required(),
                TextInput::make('value')
                    ->required(),
            ]);
    }
}
