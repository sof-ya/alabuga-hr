<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\Mission;
use App\Services\MissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
    }

    public function addResultToUser(Mission $mission, Request $request, MissionService $service) : BaseResponse {
        $validated = $request->validate([
            'file' => [
                'file'
            ], 
            'text' => [
                'string'
            ]
        ]);

        return new BaseResponse($service->addResultToUser($mission, ...$validated));
    }
}
