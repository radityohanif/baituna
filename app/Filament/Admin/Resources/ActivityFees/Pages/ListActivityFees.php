<?php

namespace App\Filament\Admin\Resources\ActivityFees\Pages;

use App\Filament\Admin\Resources\ActivityFees\ActivityFeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivityFees extends ListRecords
{
    protected static string $resource = ActivityFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
