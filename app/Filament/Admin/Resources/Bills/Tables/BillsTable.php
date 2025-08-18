<?php

namespace App\Filament\Admin\Resources\Bills\Tables;

use App\Enums\BillStatus;
use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\FeeType;
use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.name'),
                TextColumn::make('activity_fee.name'),
                TextColumn::make('amount')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filters([
                SelectFilter::make('status')
                    ->options(BillStatus::class),
                SelectFilter::make('member_id')
                    ->label('Member')
                    ->searchable()
                    ->options(Member::all()->pluck('name', 'id')),
                SelectFilter::make('activity_id')
                    ->label('Activity')
                    ->options(Activity::all()->pluck('name', 'id'))
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereHas('activity_fee', function ($q) use ($data) {
                                $q->where('activity_id', $data['value']);
                            });
                        }
                    }),
                SelectFilter::make('fee_type_id')
                    ->label('Fee Type')
                    ->options(FeeType::all()->pluck('name', 'id'))
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereHas('activity_fee', function ($q) use ($data) {
                                $q->where('fee_type_id', $data['value']);
                            });
                        }
                    }),
                SelectFilter::make('academic_year_id')
                    ->label('Academic Year')
                    ->options(AcademicYear::all()->pluck('name', 'id'))
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereHas('activity_fee', function ($q) use ($data) {
                                $q->where('academic_year_id', $data['value']);
                            });
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make()->slideOver(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
