<?php

namespace App\Filament\Admin\Resources\Bills\Pages;

use App\Filament\Admin\Resources\Bills\BillResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBill extends CreateRecord
{
    protected static string $resource = BillResource::class;
}
