<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case BankTransfer = 'tf';
    case Cash = 'cash';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BankTransfer => 'Bank Transfer',
            self::Cash => 'Cash',
        };
    }
}
