<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Mission;
use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BranchService
{
    public function index(?int $page = null, ?int $perPage = null) : LengthAwarePaginator {
        $builder = auth()->user()->branches()->orderBy('priority_rank');

        return $builder->paginate(perPage: $perPage, page: $page);
    }

    public function requirements(Branch $branch) : array {
        $builder = $branch->defaultBuilder()->orderBy('priority_rank')->where('b.id', $branch->id);

        $missions = DB::table('branch_requirements as br')
        ->join('missions as m', 'br.mission_requirement_id', '=', 'm.id')
        ->leftJoin('user_missions as um', function ($join) {
            $join->on('m.id', '=', 'um.mission_id')
                 ->where('um.user_id', '=', auth()->user()->id);
        })
        ->where('br.branch_id', $branch->id)
        ->select([
            'm.id',
            'm.name',
            'm.description',
            'um.status_mission',
            DB::raw("CASE WHEN um.status_mission = 'Завершено' THEN true ELSE false END as is_completed"),
        ])
        ->get();

        $branches = DB::table('branch_requirements as br')
            ->join('branches as b', 'br.branch_requirement_id', '=', 'b.id')
            ->leftJoin('branch_missions as bm', function($join) {
                $join->on('b.id', '=', 'bm.branch_id')
                    ->where('bm.is_active', true);
            })
            ->leftJoin('user_missions as um', function($join) {
                $join->on('bm.mission_id', '=', 'um.mission_id')
                    ->where('um.user_id', auth()->user()->id);
            })
            ->select([
                'br.branch_requirement_id',
                'b.name as branch_name',
                DB::raw('COUNT(DISTINCT bm.mission_id) as total_missions'),
                DB::raw("COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END) as completed_missions"),
                DB::raw("CASE 
                    WHEN COUNT(DISTINCT bm.mission_id) = COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END) 
                        AND COUNT(DISTINCT bm.mission_id) > 0 
                    THEN TRUE 
                    ELSE FALSE 
                END as is_completed"),
                DB::raw("ROUND(
                    (COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END) * 100.0 / NULLIF(COUNT(DISTINCT bm.mission_id), 0)), 
                    0
                ) as progress_percent"),
                DB::raw("CASE 
                    WHEN COUNT(DISTINCT bm.mission_id) = COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END) 
                        AND COUNT(DISTINCT bm.mission_id) > 0 THEN 'Завершена'
                    WHEN COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END) = 0 THEN 'Не начата'
                    ELSE CONCAT('В процессе (', 
                        COUNT(DISTINCT CASE WHEN um.status_mission = 'Завершено' THEN um.mission_id END), 
                        '/', 
                        COUNT(DISTINCT bm.mission_id), 
                        ')')
                END as status_display")
            ])
            ->where('br.branch_id', $branch->id)
            ->whereNotNull('br.branch_requirement_id')
            ->groupBy('br.branch_requirement_id', 'b.name')
            ->orderByRaw('is_completed, progress_percent DESC')
            ->get();

        return [
            'role' => Role::find($builder->get('users.role_id')),
            'experience' => $builder->max('b.requirement_experience'),
            'branches' => $branches,
            'missions' => $missions
        ];
    }
}
