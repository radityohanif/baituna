<?php

namespace App\Filament\Admin\Resources\FeeTypes\Pages;

use App\Filament\Admin\Resources\FeeTypes\FeeTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeeType extends CreateRecord
{
    protected static string $resource = FeeTypeResource::class;
}
