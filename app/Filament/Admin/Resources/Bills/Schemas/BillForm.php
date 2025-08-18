<?php

namespace App\Filament\Admin\Resources\Bills\Schemas;

use App\Components\Forms\MoneyInput;
use App\Enums\BillStatus;
use App\Models\ActivityFee;
use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextEntry::make('status')->badge(),
                    TextEntry::make('remaining_payment')
                        ->label('Remaining')
                        ->money(currency: 'IDR'),
                ])->hiddenOn(['create']),
                Group::make()
                    ->columns(2)
                    ->columnSpan(2)
                    ->schema([
                        Hidden::make('status')
                            ->default(fn() => BillStatus::Pending),
                        DatePicker::make('date')
                            ->label('Bill Date')
                            ->required()
                            ->disabledOn(['edit'])
                            ->default(fn() => now()),
                        Select::make('member_id')
                            ->label('Member')
                            ->searchable()
                            ->disabledOn(['edit'])
                            ->options(fn() => Member::all()->pluck('name', 'id'))
                            ->required(),
                        Select::make('activity_fee_id')
                            ->label('Activity Fee')
                            ->disabledOn(['edit'])
                            ->options(fn() => ActivityFee::all()->pluck('name', 'id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $fee = ActivityFee::find($state);
                                $set('amount', $fee->amount);
                            }),
                        MoneyInput::make('amount'),
                    ])
            ])->columns(2)->inlineLabel();
    }
}
