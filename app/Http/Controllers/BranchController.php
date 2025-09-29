<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchCollection;
use App\Models\Branch;
use App\Services\BranchService;
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
            'perPage' => 'integer'
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
}
