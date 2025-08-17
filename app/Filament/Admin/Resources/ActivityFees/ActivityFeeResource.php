<?php

namespace App\Filament\Admin\Resources\ActivityFees;

use App\Filament\Admin\Resources\ActivityFees\Pages\ListActivityFees;
use App\Filament\Admin\Resources\ActivityFees\Schemas\ActivityFeeForm;
use App\Filament\Admin\Resources\ActivityFees\Tables\ActivityFeesTable;
use App\Models\ActivityFee;
use BackedEnum;
use CodeWithDennis\FilamentLucideIcons\Enums\LucideIcon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ActivityFeeResource extends Resource
{
    protected static ?string $model = ActivityFee::class;

    protected static string|UnitEnum|null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = LucideIcon::DollarSign;

    public static function form(Schema $schema): Schema
    {
        return ActivityFeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityFeesTable::configure($table);
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
            'index' => ListActivityFees::route('/'),
        ];
    }
}
