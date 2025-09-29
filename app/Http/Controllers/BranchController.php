<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchCollection;
use App\Http\Resources\MissionCollection;
use App\Http\Responses\BaseResponse;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BranchService $service) : BranchCollection {
        $validated = $request->validate([
            'page' => 'integer',
            'perPage' => 'integer',
            'perPage' => 'integer',
            'onlyCompleted' => 'boolean'
        ]);

        return new BranchCollection($service->index(...$validated));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }

    public function requirements(Branch $branch, BranchService $service) : BaseResponse {
        return new BaseResponse($service->requirements($branch), JsonResponse::HTTP_OK);
    }

    public function missionsList(Branch $branch) : MissionCollection {
        return new MissionCollection($branch->missions()->get());
    }
}
