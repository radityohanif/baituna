<?php

namespace App\Filament\Admin\Resources\AcademicYears;

use App\Filament\Admin\Resources\AcademicYears\Pages\ListAcademicYears;
use App\Filament\Admin\Resources\AcademicYears\Schemas\AcademicYearForm;
use App\Filament\Admin\Resources\AcademicYears\Tables\AcademicYearsTable;
use App\Models\AcademicYear;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;

    protected static string|UnitEnum|null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AcademicYearForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicYearsTable::configure($table);
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
            'index' => ListAcademicYears::route('/'),
        ];
    }
}
