<?php

namespace App\Filament\Resources\BusinessDetails\Pages;

use App\Filament\Resources\BusinessDetails\BusinessDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBusinessDetails extends ListRecords
{
    protected static string $resource = BusinessDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
