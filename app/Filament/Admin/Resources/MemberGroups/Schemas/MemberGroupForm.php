<?php

namespace App\Filament\Admin\Resources\MemberGroups\Schemas;

use App\Models\Activity;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('activity_id')
                    ->label('Activity')
                    ->options(fn() => Activity::all()->pluck('name', 'id'))
                    ->required(),
                TextInput::make('name')
                    ->required(),
            ])
            ->inlineLabel()
            ->columns(1);
    }
}
