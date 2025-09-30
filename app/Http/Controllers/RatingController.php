<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Services\RatingService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OAT;

class RatingController extends Controller
{
    public function __construct(private RatingService $ratingService) {

    }

    #[OAT\Get(
        path: "/api/rating/list",
        summary: "Получить рейтинг пользователей по текущей роли и рангу",
        description: "Возвращает список пользователей, отсортированный по опыту (experience) в рамках роли и ранга текущего авторизованного пользователя",
        tags: ["rating"],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ со списком пользователей в рейтинге",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "data", ref: "#/components/schemas/UsersRatingResponse"),
                        new OAT\Property(property: "message", type: "string", nullable: true),
                        new OAT\Property(property: "status", type: "integer", example: 200),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "message", type: "string", example: "Unauthenticated."),
                    ]
                )
            ),
        ]
    )]
    public function getUsersRating(): BaseResponse
    {
        $ratingData = $this->ratingService->getUsersRating(
            auth()->user()->role_id,
            auth()->user()->rank_id,
        );

        return new BaseResponse($ratingData, JsonResponse::HTTP_OK);
    }

    #[OAT\Get(
        path: "/api/rating/current",
        summary: "Получить позицию текущего пользователя в рейтинге",
        description: "Возвращает позицию текущего авторизованного пользователя в рейтинге в рамках его роли и ранга",
        tags: ["rating"],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response(
                response: 200,
                description: "Успешный ответ с позицией пользователя в рейтинге",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "data", ref: "#/components/schemas/UserPositionResponse"),
                        new OAT\Property(property: "message", type: "string", nullable: true),
                        new OAT\Property(property: "status", type: "integer", example: 200),
                    ]
                )
            ),
            new OAT\Response(
                response: 401,
                description: "Неавторизованный доступ",
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: "message", type: "string", example: "Unauthenticated."),
                    ]
                )
            ),
        ]
    )]
    public function getMyRatingPosition() : BaseResponse {
        $ratingData = $this->ratingService->getUserPosition(
            auth()->user(),
            auth()->user()->role_id,
            auth()->user()->rank_id,
        );

        return new BaseResponse($ratingData, JsonResponse::HTTP_OK);
    }
}
