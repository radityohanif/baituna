<?php

namespace App\Filament\Admin\Resources\Members\Schemas;

use App\Models\AcademicYear;
use App\Models\Activity;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MemberActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('activity_id')
                    ->label('Activity')
                    ->required()
                    ->options(fn() => Activity::all()->pluck('name', 'id')),
                Select::make('enrollment_year_id')
                    ->label('Enrolment Academic Year')
                    ->options(fn() => AcademicYear::all()->pluck('name', 'id')),
            ])
            ->inlineLabel()
            ->columns(1);
    }
}
