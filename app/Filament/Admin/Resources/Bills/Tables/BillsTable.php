<?php

namespace App\Filament\Admin\Resources\Bills\Tables;

use App\Enums\BillStatus;
use App\Filament\Admin\Resources\Payments\Schemas\PaymentForm;
use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\FeeType;
use App\Models\Member;
use App\Models\Payment;
use CodeWithDennis\FilamentLucideIcons\Enums\LucideIcon;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')->sortable(),
                TextColumn::make('member.name'),
                TextColumn::make('date')
                    ->label('Month')
                    ->date(format: 'M-Y'),
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
                Filter::make('billing_month')
                    ->label('Billing Month')
                    ->schema([
                        DatePicker::make('month')
                            ->label('Bill Period')
                            ->displayFormat('F Y') // tampilannya "Aug 2025"
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['month'],
                                fn($query, $date) => $query
                                    ->whereMonth('date', Carbon::parse($date)->month)
                                    ->whereYear('date', Carbon::parse($date)->year),
                            );
                    }),
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
                    BulkAction::make('make_full_payment')
                        ->icon(LucideIcon::CircleCheck)
                        ->color('primary')
                        ->schema(
                            fn($schema) =>
                            PaymentForm::configure(
                                schema: $schema,
                                bulkPayment: true
                            )
                        )
                        ->slideOver()
                        ->action(function ($records, array $data) {
                            foreach ($records as $record) {
                                if ($record->remaining > 0) {
                                    $data['amount'] = $record->remaining;
                                    $data['member_id'] = $record->member_id;
                                    $data['bill_id'] = $record->id;
                                    Payment::create($data);
                                    $record->status = BillStatus::Paid;
                                    $record->save();
                                }
                            }
                            Notification::make()
                                ->title('Bill Paid in Full')
                                ->body('Your selected bill is now fully settled.')
                                ->success()
                                ->send();
                        })
                ]),
            ]);
    }
}
