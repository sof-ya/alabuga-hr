<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\StoreItem;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, StoreService $service)
    {
        $validated = $request->validate([
            'page' => 'integer',
            'perPage' => 'integer',
            'in_storage' => 'boolean',
            'only_available' => 'boolean',
        ]);

        return new BaseResponse($service->index(...$validated));
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
    public function show(StoreItem $storeItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreItem $storeItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreItem $storeItem)
    {
        //
    }
}
