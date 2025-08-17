<?php

namespace App\Components\Forms;

use Filament\Forms;

class MoneyInput
{
    public static function make(string $key): Forms\Components\TextInput
    {
        return NumberInput::make($key)->prefix('Rp.');
    }
}
