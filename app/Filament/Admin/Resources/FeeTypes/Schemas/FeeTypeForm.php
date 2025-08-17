<?php

namespace App\Filament\Admin\Resources\FeeTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FeeTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Toggle::make('is_recurring')
                    ->label('Recurring Payment') // optional, clearer label
                    ->helperText('Check this if the fee is recurring every month, e.g., monthly tuition (SPP).')
                    ->required(),
            ])->columns(1)->inlineLabel();
    }
}
