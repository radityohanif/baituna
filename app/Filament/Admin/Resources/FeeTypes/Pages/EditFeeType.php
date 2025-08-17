<?php

namespace App\Filament\Admin\Resources\FeeTypes\Pages;

use App\Filament\Admin\Resources\FeeTypes\FeeTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeeType extends EditRecord
{
    protected static string $resource = FeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
