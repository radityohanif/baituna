<?php

namespace App\Filament\Admin\Resources\FeeTypes;

use App\Filament\Admin\Resources\FeeTypes\Pages\ListFeeTypes;
use App\Filament\Admin\Resources\FeeTypes\Schemas\FeeTypeForm;
use App\Filament\Admin\Resources\FeeTypes\Tables\FeeTypesTable;
use App\Models\FeeType;
use BackedEnum;
use CodeWithDennis\FilamentLucideIcons\Enums\LucideIcon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FeeTypeResource extends Resource
{
    protected static ?string $model = FeeType::class;

    protected static string|UnitEnum|null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = LucideIcon::CreditCard;

    public static function form(Schema $schema): Schema
    {
        return FeeTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeeTypesTable::configure($table);
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
            'index' => ListFeeTypes::route('/'),
        ];
    }
}
