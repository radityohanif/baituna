<?php

namespace App\Filament\Admin\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->required(),
                            DatePicker::make('birth_date')
                                ->label('Birth Date'),
                            Select::make('gender')
                                ->label('Gender')
                                ->options([
                                    'male' => 'Male',
                                    'female' => 'Female',
                                ])
                                ->required(),
                        ]),
                    ]),

                Section::make('Parent / Guardian')
                    ->icon('heroicon-o-users')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('parent_name')
                                ->label('Parent Name'),
                            TextInput::make('phone')
                                ->label('Phone Number')
                                ->tel(),
                        ]),
                    ]),

                Section::make('Address')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Textarea::make('address')
                            ->label('Full Address')
                            ->rows(3),
                    ]),
            ])
            ->columns(1);
    }
}
