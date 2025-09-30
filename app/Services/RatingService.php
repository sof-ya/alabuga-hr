<?php

namespace App\Services;

use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RatingService
{
    public function getUsersRating(int $roleId, int $rankId): array
    {
        $users = User::orderBy('experience', 'desc')->where('role_id', $roleId)->where('rank_id', $rankId)
            ->get(['name', 'nikname', 'experience', 'role_id', 'rank_id']);


        return [
            'users' => $users,
            'filters' => [
                'role_id' => $roleId,
                'rank_id' => $rankId,
            ]
        ];
    }

    public function getUserPosition(User $user, int $roleId, int $rankId) : array {
        $position = User::orderBy('experience', 'desc')->where('role_id', $roleId)->where('rank_id', $rankId)
            ->where('experience', '>=', $user->experience)->select('experience')->groupBy('experience')->get()->count();

        return [
            'user_position' => $position,
            'filters' => [
                'role_id' => Role::find($roleId),
                'rank_id' => Rank::find($rankId),
            ]];
    }
}
