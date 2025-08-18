<?php

namespace App\Filament\Admin\Resources\Bills;

use App\Filament\Admin\Resources\Bills\Pages\CreateBill;
use App\Filament\Admin\Resources\Bills\Pages\EditBill;
use App\Filament\Admin\Resources\Bills\Pages\ListBills;
use App\Filament\Admin\Resources\Bills\Schemas\BillForm;
use App\Filament\Admin\Resources\Bills\Tables\BillsTable;
use App\Models\Bill;
use BackedEnum;
use CodeWithDennis\FilamentLucideIcons\Enums\LucideIcon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static string|UnitEnum|null $navigationGroup = 'Billing';

    protected static string|BackedEnum|null $navigationIcon = LucideIcon::FileText;

    public static function form(Schema $schema): Schema
    {
        return BillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BillsTable::configure($table);
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
            'index' => ListBills::route('/'),
        ];
    }
}
