<?php

namespace App\Filament\Admin\Resources\Members\RelationManagers;

use App\Filament\Admin\Resources\Members\Schemas\MemberActivityForm;
use App\Models\MemberActivity;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    public function form(Schema $schema): Schema
    {
        return MemberActivityForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('activity.name'),
                TextColumn::make('academic_year.name'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                ])
            ])
            ->headerActions([
                CreateAction::make()
                    ->action(function (array $data, CreateAction $action) {
                        $data['member_id'] = $this->getOwnerRecord()->id;
                        $memberActivity = MemberActivity::where([
                            'member_id' => $data['member_id'],
                            'activity_id' => $data['activity_id']
                        ])->first();
                        if ($memberActivity) {
                            Notification::make()
                                ->title('Member has already been added to this activity')
                                ->danger()
                                ->send();
                            $action->halt();
                            return;
                        }
                        MemberActivity::create($data);
                    })
                    ->slideOver(),
            ]);
    }
}
