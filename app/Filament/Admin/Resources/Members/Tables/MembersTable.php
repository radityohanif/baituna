<?php

namespace App\Filament\Admin\Resources\Members\Tables;

use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\MemberActivity;
use CodeWithDennis\FilamentLucideIcons\Enums\LucideIcon;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filters([
                SelectFilter::make('activity_id')
                    ->label('Activity')
                    ->options(fn() => Activity::all()->pluck('name', 'id'))
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereHas('activities', function ($q) use ($data) {
                                $q->where('activity_id', $data['value']);
                            });
                        }
                    }),
                SelectFilter::make('enrollment_year_id')
                    ->label('Academic Year')
                    ->options(fn() => AcademicYear::all()->pluck('name', 'id'))
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereHas('activities', function ($q) use ($data) {
                                $q->where('enrollment_year_id', $data['value']);
                            });
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('enroll_activity')
                        ->label('Enroll in Activity')
                        ->icon(LucideIcon::ArrowUpRight)
                        ->color('primary')
                        ->slideOver()
                        ->modalWidth(Width::Large)
                        ->schema([
                            Select::make('activity_id')
                                ->label('Activity')
                                ->options(fn() => Activity::all()->pluck('name', 'id'))
                                ->required(),
                            Select::make('enrollment_year_id')
                                ->label('Academic Year')
                                ->options(fn() => AcademicYear::all()->pluck('name', 'id'))
                        ])
                        ->action(function ($records, array $data) {
                            /**
                             * Enroll selected members in the chosen activity
                             * If a member is already enrolled, skip
                             */
                            foreach ($records as $record) {
                                $memberActivityData = [
                                    'member_id' => $record->id,
                                    'activity_id' => $data['activity_id'],
                                ];

                                $memberActivity = MemberActivity::where($memberActivityData)->first();

                                if (! $memberActivity) {
                                    MemberActivity::create($memberActivityData);
                                }
                            }

                            Notification::make()
                                ->title('Members successfully enrolled in the selected activity')
                                ->body('The selected members have been enrolled. Any members already enrolled were skipped.')
                                ->success()
                                ->send();
                        }),
                ]),
            ]);
    }
}
