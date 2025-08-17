<?php

namespace App\Filament\Admin\Resources\MemberGroups\Pages;

use App\Filament\Admin\Resources\MemberGroups\MemberGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMemberGroup extends CreateRecord
{
    protected static string $resource = MemberGroupResource::class;
}
