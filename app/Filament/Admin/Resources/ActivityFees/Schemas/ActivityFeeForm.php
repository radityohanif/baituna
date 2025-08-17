<?php

namespace App\Filament\Admin\Resources\ActivityFees\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ActivityFeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('activity_id')
                    ->required()
                    ->numeric(),
                TextInput::make('fee_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('academic_year_id')
                    ->numeric(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
            ]);
    }
}
