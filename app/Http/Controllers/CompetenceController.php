<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\Competence;
use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;

class CompetenceController extends Controller
{
    #[OAT\Get(
        path: "/api/competencies",
        summary: "Получить компетенции текущего пользователя",
        description: "Возвращает список всех компетенций текущего авторизованного пользователя с уровнями владения",
        tags: ["competencies"],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ со списком компетенций пользователя",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: "data",
                            type: "array",
                            description: "Массив компетенций пользователя с уровнями владения",
                            items: new OAT\Items(ref: "#/components/schemas/CompetencyResponse")
                        ),
                        new OAT\Property(
                            property: "message", 
                            type: "string", 
                            nullable: true,
                            description: "Сообщение ответа"
                        ),
                        new OAT\Property(
                            property: "status",
                            type: "integer",
                            description: "HTTP статус код",
                            example: 200
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: "message",
                            type: "string", 
                            example: "Unauthenticated."
                        ),
                        new OAT\Property(
                            property: "status",
                            type: "integer",
                            example: 401
                        ),
                    ]
                )
            ),
        ]
    )]
    public function index()
    {
        return new BaseResponse(auth()->user()->competencies()->get());
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
    public function show(Competence $competence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        //
    }
}
