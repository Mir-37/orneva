<?php

namespace App\Filament\Customer\Resources\Orders;

use BackedEnum;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Customer\Resources\Orders\Pages\EditOrder;
use App\Filament\Customer\Resources\Orders\Pages\ViewOrder;
use App\Filament\Customer\Resources\Orders\Pages\ListOrders;
use App\Filament\Customer\Resources\Orders\Pages\CreateOrder;
use App\Filament\Customer\Resources\Orders\Schemas\OrderForm;
use App\Filament\Customer\Resources\Orders\Tables\OrdersTable;
use App\Filament\Customer\Resources\Orders\Schemas\OrderInfolist;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'order_no';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
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
            'index' => ListOrders::route('/'),
            // 'create' => CreateOrder::route('/create'),
            'view' => ViewOrder::route('/{record}'),
            // 'edit' => EditOrder::route('/{record}/edit'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }
}
