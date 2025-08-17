<?php

namespace App\Filament\Admin\Resources\MemberGroups\Pages;

use App\Filament\Admin\Resources\MemberGroups\MemberGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberGroup extends EditRecord
{
    protected static string $resource = MemberGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
