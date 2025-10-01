<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $mission = $this->resource;
        $data = [
            'id' => $mission->id,
            'name' => $mission->name,
            'description' => $mission->descroption,
            'reward_experience' => $mission->reward_experience,
            'reward_gold' => $mission->reward_gold,
            'image' => $mission->image,
            'created_at' => $mission->created_at,
            'updated_at' => $mission->updated_at,
            'is_active' => $mission->is_active
        ];

        return $data;
    }
}
