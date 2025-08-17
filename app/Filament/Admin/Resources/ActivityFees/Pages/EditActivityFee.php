<?php

namespace App\Filament\Admin\Resources\ActivityFees\Pages;

use App\Filament\Admin\Resources\ActivityFees\ActivityFeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActivityFee extends EditRecord
{
    protected static string $resource = ActivityFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
