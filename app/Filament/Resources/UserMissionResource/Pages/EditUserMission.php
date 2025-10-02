<?php

namespace App\Filament\Resources\UserMissionResource\Pages;

use App\Filament\Resources\UserMissionResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserMission extends EditRecord
{
    protected static string $resource = UserMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array {  
        if($data['status_mission'] == 'Завершено') {
            $user = User::find($data['user_id']);
            $mission = $user->missions()->find($data['mission_id']);
            $user->update([
                'experience' => $user->experience + $mission->reward_experience,
                'gold' => $user->gold + $mission->reward_gold
            ]);
        }
        return $data;  
    }  
}
