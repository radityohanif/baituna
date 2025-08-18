<?php

namespace App\Components\Forms;

use Filament\Forms;
use Filament\Support\RawJs;

class NumberInput
{
    public static function make(string $key): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make($key)
            ->required()
            ->mask(
                RawJs::make(<<<'JS'
                    $money($input, ',', '.', 3)
                JS)
            )
            ->reactive()
            ->stripCharacters('.');
    }
}
