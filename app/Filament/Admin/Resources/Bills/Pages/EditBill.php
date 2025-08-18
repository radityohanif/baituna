<?php

namespace App\Filament\Admin\Resources\Bills\Pages;

use App\Filament\Admin\Resources\Bills\BillResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class EditBill extends EditRecord
{
    protected static string $resource = BillResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->getRecord()->number;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('tes')
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
