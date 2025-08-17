<?php

namespace App\Filament\Admin\Resources\MemberGroups;

use App\Filament\Admin\Resources\MemberGroups\Pages\CreateMemberGroup;
use App\Filament\Admin\Resources\MemberGroups\Pages\EditMemberGroup;
use App\Filament\Admin\Resources\MemberGroups\Pages\ListMemberGroups;
use App\Filament\Admin\Resources\MemberGroups\Schemas\MemberGroupForm;
use App\Filament\Admin\Resources\MemberGroups\Tables\MemberGroupsTable;
use App\Models\MemberGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberGroupResource extends Resource
{
    protected static ?string $model = MemberGroup::class;

    protected static string|UnitEnum|null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MemberGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberGroupsTable::configure($table);
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
            'index' => ListMemberGroups::route('/'),
            'create' => CreateMemberGroup::route('/create'),
            'edit' => EditMemberGroup::route('/{record}/edit'),
        ];
    }
}
