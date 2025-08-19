<?php

namespace App\Filament\Admin\Resources\Payments\Pages;

use App\Filament\Admin\Resources\Bills\Pages\EditBill;
use App\Filament\Admin\Resources\Payments\PaymentResource;
use App\Livewire\PaymentReceipt;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Illuminate\Contracts\Support\Htmlable;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->getRecord()->number;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Group::make()
                ->columns(1)
                ->columnSpan(4)
                ->schema([
                    Action::make('printPdf')
                        ->label('Print')
                        ->outlined()
                        ->icon('heroicon-m-printer')
                        ->action(function ($livewire) {
                            $record = $this->getRecord();
                            $url = route('documents.print', [
                                'id' => $record->id,
                            ]);
                            $livewire->js("window.printPdf('{$url}')");
                        }),
                    TextEntry::make('bill.number')
                        ->label('Bill')
                        ->color('primary')
                        ->weight(FontWeight::Bold)
                        ->url(EditBill::getUrl(['record' => $this->getRecord()->bill_id])),
                    TextEntry::make('payment_date')->date(),
                    TextEntry::make('amount')->money(currency: 'IDR'),
                    TextEntry::make('method'),
                    TextEntry::make('notes'),
                ]),
            Livewire::make(
                component: PaymentReceipt::class,
                data: [
                    'payment' => $this->getRecord()
                ]
            )->columnSpan(4)
        ])->columns(8);
    }
}
