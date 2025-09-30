<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchCollection;
use App\Http\Resources\MissionCollection;
use App\Http\Responses\BaseResponse;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;


class BranchController extends Controller
{
    #[OAT\Get(
        path: "/api/branches",
        summary: "Получить список веток с пагинацией",
        description: "Возвращает список веток для текущего пользователя с возможностью фильтрации по завершенности",
        tags: ["branches"],
        parameters: [
            new OAT\Parameter(
                name: "page",
                description: "Номер страницы",
                in: "query",
                required: false,
                schema: new OAT\Schema(type: "integer", minimum: 1, default: 1)
            ),
            new OAT\Parameter(
                name: "perPage",
                description: "Количество элементов на странице",
                in: "query",
                required: false,
                schema: new OAT\Schema(type: "integer", minimum: 1, maximum: 100, default: 15)
            ),
            new OAT\Parameter(
                name: "onlyCompleted",
                description: "Фильтр по завершенным веткам",
                in: "query",
                required: false,
                schema: new OAT\Schema(type: "boolean")
            ),
        ],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ со списком веток",
                content: new OAT\JsonContent(
                    allOf: [
                        new OAT\Schema('#/components/schemas/LengthAwarePaginator'),
                        new OAT\Schema(
                            properties: [
                                new OAT\Property(
                                    property: "data",
                                    type: "array",
                                    items: new OAT\Items(ref: "#/components/schemas/Branch")
                                ),
                            ]
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ"
            ),
        ]
    )]
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

    #[OAT\Get(
        path: "/api/branches/requirements/{branch}",
        summary: "Получить требования и прогресс по ветке",
        description: "Возвращает информацию о требованиях для доступа к ветке и текущий прогресс выполнения",
        tags: ["branches"],
        parameters: [
            new OAT\Parameter(
                name: "branch",
                description: "ID ветки",
                in: "path",
                required: true,
                schema: new OAT\Schema(type: "integer", example: 1)
            ),
        ],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ с требованиями ветки",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "data", ref: "#/components/schemas/BranchRequirements"),
                        new OAT\Property(property: "message", type: "string", nullable: true),
                        new OAT\Property(property: "status", type: "integer", example: 200),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ"
            ),
            new OAT\Response(
                response: 404,
                description: "Ветка не найдена"
            ),
        ]
    )]
    public function requirements(Branch $branch, BranchService $service) : BaseResponse {
        return new BaseResponse($service->requirements($branch), JsonResponse::HTTP_OK);
    }

    #[OAT\Get(
        path: "/api/branches/{branch}/missions",
        summary: "Получить список миссий ветки",
        description: "Возвращает все миссии, принадлежащие указанной ветке",
        tags: ["branches"],
        parameters: [
            new OAT\Parameter(
                name: "branch",
                description: "ID ветки",
                in: "path",
                required: true,
                schema: new OAT\Schema(type: "integer", example: 1)
            ),
        ],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ со списком миссий",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: "data",
                            type: "array",
                            items: new OAT\Items(ref: "#/components/schemas/Mission")
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ"
            ),
            new OAT\Response(
                response: 404,
                description: "Ветка не найдена"
            ),
        ]
    )]

    public function missionsList(Branch $branch) : MissionCollection {
        return new MissionCollection($branch->missions()->get());
    }
}
