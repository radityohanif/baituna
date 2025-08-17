<?php

namespace App\Filament\Admin\Resources\MemberGroups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('academic_year_id')
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
