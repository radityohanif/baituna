<?php

namespace App\Filament\Admin\Resources\FeeTypes\Pages;

use App\Filament\Admin\Resources\FeeTypes\FeeTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeeTypes extends ListRecords
{
    protected static string $resource = FeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
