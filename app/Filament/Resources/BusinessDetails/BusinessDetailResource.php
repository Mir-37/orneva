<?php

namespace App\Filament\Resources\BusinessDetails;

use App\Filament\Resources\BusinessDetails\Pages\CreateBusinessDetail;
use App\Filament\Resources\BusinessDetails\Pages\EditBusinessDetail;
use App\Filament\Resources\BusinessDetails\Pages\ListBusinessDetails;
use App\Filament\Resources\BusinessDetails\Schemas\BusinessDetailForm;
use App\Filament\Resources\BusinessDetails\Tables\BusinessDetailsTable;
use App\Models\BusinessDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BusinessDetailResource extends Resource
{
    protected static ?string $model = BusinessDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema
    {
        return BusinessDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BusinessDetailsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessDetails::route('/'),
            'create' => CreateBusinessDetail::route('/create'),
            'edit' => EditBusinessDetail::route('/{record}/edit'),
        ];
    }
}
