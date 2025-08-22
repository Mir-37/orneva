<?php

namespace App\Filament\Resources\Newsletters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subscribed_email')
                    ->email()
                    ->required(),
            ]);
    }
}
