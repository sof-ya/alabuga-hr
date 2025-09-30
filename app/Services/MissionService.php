<?php

namespace App\Services;

use App\Models\Mission;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MissionService
{
    public function addResultToUser(Mission $mission, ?UploadedFile $file = null, ?string $text) : Mission {
        $user = auth()->user();
        
        $filename = null;

        if ($file) {
            $filename = Storage::disk('public')->put('files/missions_results/user'.auth()->user()->id.'/mission'.$mission->id, $file);
        }
        
        $resultJson = json_encode([
            'file' => $filename,
            'text' => $text
        ]);

        $userMission = $user->missions()->where('mission_id', $mission->id)->first();

        if ($userMission) {
            $user->missions()->updateExistingPivot($mission->id, [
                'status_mission' => 'Ожидает проверку',
                'result' => $resultJson,
                'updated_at' => now()
            ]);
        } else {
            $user->missions()->attach($mission->id, [
                'status_mission' => 'Ожидает проверку',
                'result' => $resultJson,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $updatedUserMission = $user->missions()
            ->where('mission_id', $mission->id)
            ->withPivot('status_mission', 'result', 'created_at', 'updated_at')
            ->first();

        return $updatedUserMission;
    }
}
