<?php

namespace App\Http\Resources;

use App\Models\Rank;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $branch = $this->resource;
        $data = [
            'id' => $branch->id,
            'name' => $branch->name,
            'description' => $branch->descroption,
            'image_url' => $branch->image_url,
            'priority_rank' => $branch->priority_rank,
            'requirement_role_id' => Role::find($branch->requirement_role_id),
            'requirement_rank_id' => Rank::find($branch->requirement_rank_id),
            'requirement_experience' => $branch->requirement_experience,
            'progress' => $branch->progress,
            'is_finished' => $branch->is_finished,
            'is_visible' => $branch->is_visible,
            'is_active' => $branch->is_active,
            'created_at' => $branch->created_at,
            'updated_at' => $branch->updated_at,
        ];

        return $data;
    }
}
