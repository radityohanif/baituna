<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use App\Components\Forms\MoneyInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(
        Schema $schema,
        int $billAmount = 0
    ): Schema {
        return $schema
            ->components([
                MoneyInput::make('amount')
                    ->label('Payment Amount')
                    ->columnSpanFull()
                    ->required()
                    ->default(fn() => $billAmount),

                DatePicker::make('payment_date')
                    ->label('Payment Date')
                    ->default(fn() => now())
                    ->required(),

                Select::make('method')
                    ->label('Payment Method')
                    ->options([
                        'tf' => 'Bank Transfer',
                        'cash' => 'Cash',
                    ])
                    ->default(fn() => 'tf')
                    ->required(),

                Textarea::make('notes')
                    ->label('Notes')
                    ->helperText('Add any additional remarks (optional).')
                    ->columnSpanFull(),

                FileUpload::make('evidence')
                    ->label('Payment Evidence')
                    ->helperText('Upload proof of payment, such as receipt or transfer slip.')
                    ->columnSpanFull()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ]),
            ])
            ->columns(2);
    }
}
