<?php

namespace App\Filament\Admin\Resources\Bills\Pages;

use App\Filament\Admin\Resources\Bills\BillResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBill extends EditRecord
{
    protected static string $resource = BillResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->getRecord()->number;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
