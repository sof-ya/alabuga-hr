<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\StoreItem;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, StoreService $service) : BaseResponse {
        $validated = $request->validate([
            'page' => 'integer',
            'perPage' => 'integer',
            'in_storage' => 'boolean',
            'only_available' => 'boolean',
        ]);

        return new BaseResponse($service->index(...$validated));
    }

    public function buy(StoreItem $item, StoreService $service) : BaseResponse|JsonResponse {

        if($item->price > auth()->user()->gold) {
            return response()->json([
                'message' => 'Недостаточно средств для покупки товара.',
            ], 403);
        }

        $service->buyItem($item);

        return new BaseResponse(['stire_item_id' => $item->id]);
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
