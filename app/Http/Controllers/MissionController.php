<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\Mission;
use App\Services\MissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OAT;

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

     #[OAT\Post(
        path: "/api/missions/{mission}/result",
        summary: "Добавить результат выполнения миссии пользователем",
        description: "Позволяет пользователю добавить результат выполнения миссии (файл или текст)",
        tags: ["Missions"],
        parameters: [
            new OAT\Parameter(
                name: "mission",
                description: "ID миссии",
                in: "path",
                required: true,
                schema: new OAT\Schema(type: "integer", example: 1)
            ),
        ],
        security: [["JWT" => []]],
        requestBody: new OAT\RequestBody(
            description: "Данные результата выполнения миссии",
            required: true,
            content: new OAT\MediaType(
                mediaType: "multipart/form-data",
                schema: new OAT\Schema(
                    type: "object",
                    properties: [
                        new OAT\Property(
                            property: "file",
                            description: "Файл результата",
                            type: "string",
                            format: "binary",
                            nullable: true
                        ),
                        new OAT\Property(
                            property: "text",
                            description: "Текстовый результат",
                            type: "string",
                            nullable: true,
                            example: "Описание выполненной работы"
                        ),
                    ]
                )
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: "Результат успешно добавлен",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "data", ref: "#/components/schemas/Mission"),
                        new OAT\Property(property: "message", type: "string", nullable: true),
                        new OAT\Property(property: "status", type: "integer", example: 200),
                    ]
                )
            ),
            new OAT\Response(
                response: 422,
                description: "Ошибка валидации",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "error", type: "string", example: "Ошибка валидации"),
                        new OAT\Property(
                            property: "details",
                            type: "object",
                            properties: [
                                new OAT\Property(property: "file", type: "array", items: new OAT\Items(type: "string")),
                                new OAT\Property(property: "text", type: "array", items: new OAT\Items(type: "string")),
                            ]
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
                description: "Миссия не найдена"
            ),
        ]
    )]

    public function addResultToUser(Mission $mission, Request $request, MissionService $service) : BaseResponse {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file',
            'text' => 'nullable|required_without:file|string'
        ], [
            'file.file' => 'Поле должно содержать файл',
            'text.required_without' => 'Необходимо предоставить либо файл, либо текст'
        ]);

        if ($validator->fails()) {
            return new BaseResponse([
                'error' => 'Ошибка валидации',
                'details' => $validator->errors()->toArray()
            ], 422);
        }

        $file = $request->file('file');
        $text = $validated['text'] ?? null;


        return new BaseResponse($service->addResultToUser($mission, $file, $text));
    }
}
