<?php

namespace App\Filament\Admin\Resources\Bills\Schemas;

use App\Components\Forms\MoneyInput;
use App\Enums\BillStatus;
use App\Models\ActivityFee;
use App\Models\Member;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('status')
                    ->default(fn() => BillStatus::Pending),
                Select::make('member_id')
                    ->label('Member')
                    ->searchable()
                    ->options(fn() => Member::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('activity_fee_id')
                    ->label('Activity Fee')
                    ->options(fn() => ActivityFee::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $fee = ActivityFee::find($state);
                        $set('amount', $fee->amount);
                    }),
                MoneyInput::make('amount'),
            ])->columns(1)->inlineLabel();
    }
}
