<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BranchService
{
    public function index(?int $page = null, ?int $perPage = null) : LengthAwarePaginator {
        $builder = auth()->user()->branches()->orderBy('priority_rank');

        return $builder->paginate(perPage: $perPage, page: $page);
    }
}
