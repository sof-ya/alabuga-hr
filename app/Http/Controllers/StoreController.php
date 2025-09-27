<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\StoreItem;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;

class StoreController extends Controller
{
    #[OAT\Get(
        path: '/api/store',
        summary: 'Get store items',
        tags: ['store'],
        parameters: [
            new OAT\Parameter(ref: '#/components/parameters/page'),
            new OAT\Parameter(ref: '#/components/parameters/per_page'),
            new OAT\Parameter(ref: '#/components/parameters/in_storage'),
            new OAT\Parameter(ref: '#/components/parameters/only_available'),
        ],
        security: [["JWT" => []]],
        responses: [new OAT\Response(
            response: JsonResponse::HTTP_OK,
            description: 'Successful response',
            content: new OAT\JsonContent(type: 'array', items: new OAT\Items('#/components/schemas/StoreItem')))
        ],
    )]
    
    public function index(Request $request, StoreService $service) : BaseResponse {
        $validated = $request->validate([
            'page' => 'integer',
            'perPage' => 'integer',
            'in_storage' => 'boolean',
            'only_available' => 'boolean',
        ]);

        return new BaseResponse($service->index(...$validated));
    }

    #[OAT\Patch(
        path: '/api/store/buy/{id}',
        summary: 'Buy store item',
        tags: ['store'],
        parameters: [new OAT\Parameter(ref: '#/components/parameters/id')],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response('#/components/responses/ErrorResponse', JsonResponse::HTTP_BAD_REQUEST),
            new OAT\Response('#/components/responses/ValidationErrorsResponse', JsonResponse::HTTP_UNPROCESSABLE_ENTITY),
        ],

    )]
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
