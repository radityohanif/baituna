<?php

namespace App\Filament\Admin\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('member_group_id')
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                DatePicker::make('birth_date'),
                TextInput::make('gender'),
                TextInput::make('parent_name'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('address'),
            ]);
    }
}
