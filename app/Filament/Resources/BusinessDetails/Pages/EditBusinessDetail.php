<?php

namespace App\Filament\Resources\BusinessDetails\Pages;

use App\Filament\Resources\BusinessDetails\BusinessDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBusinessDetail extends EditRecord
{
    protected static string $resource = BusinessDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
