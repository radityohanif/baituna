<?php

namespace App\Filament\Admin\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                DatePicker::make('start_date')
                    ->default(fn() => today())
                    ->required(),
            ])
            ->columns(1)
            ->inlineLabel();
    }
}
