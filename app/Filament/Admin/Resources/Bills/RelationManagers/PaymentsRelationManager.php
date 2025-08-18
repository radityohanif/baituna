<?php

namespace App\Filament\Admin\Resources\Bills\RelationManagers;

use App\Enums\BillStatus;
use App\Filament\Admin\Resources\Payments\Schemas\PaymentForm;
use App\Models\Payment;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Schema $schema): Schema
    {
        return PaymentForm::configure(
            schema: $schema,
            billAmount: $this->ownerRecord->remaining
        );
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number'),
                TextColumn::make('amount')->money(currency: 'IDR'),
                TextColumn::make('payment_date')->dateTime(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->action(function (array $data, CreateAction $action) {
                        $data['member_id'] = $this->getOwnerRecord()->member_id;
                        $data['bill_id'] = $this->getOwnerRecord()->id;
                        $remaining = $this->getOwnerRecord()->remaining;

                        if ($remaining <= 0) {
                            Notification::make()
                                ->danger()
                                ->title('Bill already paid')
                                ->body('This bill has been fully paid.')
                                ->send();
                            $action->halt();
                        }

                        $paymentAmount = intval($data['amount']);

                        if ($remaining > $paymentAmount) {
                            $this->getOwnerRecord()->status = BillStatus::Partial;
                        } else {
                            $this->getOwnerRecord()->status = BillStatus::Paid;
                        }

                        $this->getOwnerRecord()->save();

                        Payment::create($data);
                    })
                    ->slideOver(),
            ])
            ->recordActions([
                ViewAction::make()->slideOver(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
