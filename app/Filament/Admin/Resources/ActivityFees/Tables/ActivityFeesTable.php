<?php

namespace App\Filament\Admin\Resources\ActivityFees\Tables;

use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\FeeType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityFeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('activity.name')
                    ->searchable(),
                TextColumn::make('fee_type.name')
                    ->searchable(),
                TextColumn::make('academic_year.name')
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
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
                SelectFilter::make('activity_id')
                    ->label('Activity')
                    ->options(fn() => Activity::all()->pluck('name', 'id')),
                SelectFilter::make('academic_year_id')
                    ->label('Academic Year')
                    ->options(fn() => AcademicYear::all()->pluck('name', 'id')),
                SelectFilter::make('fee_type_id')
                    ->label('Fee Type')
                    ->options(fn() => FeeType::all()->pluck('name', 'id')),
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver()
                    ->mutateRecordDataUsing(function (array $data) {
                        return $data;
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
