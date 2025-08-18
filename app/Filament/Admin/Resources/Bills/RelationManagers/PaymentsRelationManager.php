<?php

namespace App\Filament\Admin\Resources\Bills\RelationManagers;

use App\Enums\BillStatus;
use App\Filament\Admin\Resources\Payments\Schemas\PaymentForm;
use App\Models\Payment;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Schema $schema): Schema
    {
        return PaymentForm::configure(
            schema: $schema,
            billAmount: $this->ownerRecord->amount
        );
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->headerActions([
                CreateAction::make()
                    ->action(function (array $data) {
                        $data['bill_id'] = $this->getOwnerRecord()->id;
                        $remainingPayment = $this->getOwnerRecord()->remaining_payment;
                        $paymentAmount = intval($data['amount']);
                        if ($remainingPayment > $paymentAmount) {
                            $this->getOwnerRecord()->status = BillStatus::Partial;
                        } else {
                            $this->getOwnerRecord()->status = BillStatus::Paid;
                        }
                        Payment::create($data);
                    })
                    ->slideOver(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
