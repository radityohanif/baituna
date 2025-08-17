<?php

namespace App\Filament\Admin\Resources\ActivityFees\Schemas;

use App\Components\Forms\MoneyInput;
use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\FeeType;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ActivityFeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('activity_id')
                    ->required()
                    ->label('Activity')
                    ->options(fn() => Activity::all()->pluck('name', 'id')),
                Select::make('fee_type_id')
                    ->required()
                    ->label('Fee Type')
                    ->options(fn() => FeeType::all()->pluck('name', 'id')),
                Select::make('academic_year_id')
                    ->label('Academic Year')
                    ->options(fn() => AcademicYear::all()->pluck('name', 'id')),
                MoneyInput::make('amount')
            ])->columns(1)->inlineLabel();
    }
}
