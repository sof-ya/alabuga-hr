<?php

namespace App\Http\Controllers\Swagger;

use OpenApi\Attributes as OAT;

#[OAT\Response(
            response: 'ErrorResponse',
            description: 'Error',
            content: new OAT\JsonContent(required: ['message'], properties: [
                new OAT\Property('message', type: 'string'),
                    ]),
    ),
    OAT\Response(
            response: 'MessageResponse',
            description: 'Message',
            content: new OAT\JsonContent(required: ['message'], properties: [
                new OAT\Property('message', type: 'string'),
    ])), OAT\Schema(
            schema: 'ValidationErrors',
            required: ['message', 'errors'],
            properties: [
        new OAT\Property('message', type: 'string'),
        new OAT\Property('errors', type: 'object', example: ['field' => ['string']]),
            ],
    ), OAT\Response(
            response: 'ValidationErrorsResponse',
            description: 'Validation errors',
            content: new OAT\JsonContent(ref: '#/components/schemas/ValidationErrors'),
    ), OAT\Schema(
            schema: 'LengthAwarePaginator',
            required: ['current_page', 'data', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url', 'to', 'total'],
            properties: [
        new OAT\Property('current_page', type: 'integer', minimum: 1),
        new OAT\Property('data', type: 'array', items: new OAT\Items(type: 'object')),
        new OAT\Property('first_page_url', type: 'string'),
        new OAT\Property('from', type: 'integer', minimum: 1),
        new OAT\Property('last_page', type: 'integer', minimum: 1),
        new OAT\Property('last_page_url', type: 'string'),
        new OAT\Property('links', type: 'array', items: new OAT\Items(required: ['url', 'label', 'active'], properties: [
                    new OAT\Property('url', type: 'string', nullable: true),
                    new OAT\Property('label', type: 'string'),
                    new OAT\Property('active', type: 'boolean'),
                        ])),
        new OAT\Property('next_page_url', type: 'string', nullable: true),
        new OAT\Property('path', type: 'string', nullable: true),
        new OAT\Property('per_page', type: 'integer', minimum: 1),
        new OAT\Property('prev_page_url', type: 'string', nullable: true),
        new OAT\Property('to', type: 'integer', minimum: 1),
        new OAT\Property('total', type: 'integer', minimum: 1),
            ],
    ), OAT\Response(
            response: 'LengthAwarePaginatorResponse',
            description: 'Length aware paginator',
            content: new OAT\JsonContent(ref: '#/components/schemas/LengthAwarePaginator'),
    ), OAT\Response(
            response: 'StoreItemResponse',
            description: 'StoreItem',
            content: new OAT\JsonContent(required: ['store_item_id'], properties: [
                new OAT\Property('store_item_id', type: 'integer', minimum: 1),
                    ]),
    ), OAT\Response(
            response: 'ErrorStoreItemResponse',
            description: 'StoreItem',
            content: new OAT\JsonContent(required: ['message'], properties: [
                new OAT\Property('message', type: 'string', example: 'Недостаточно средств для покупки товара'),
                    ]),
    ), OAT\Response(
            response: 'TokenResponse',
            description: 'JWT',
            content: new OAT\JsonContent(required: ['access_token', 'token_type', 'expires_in'], properties: [
                new OAT\Property(property: 'access_token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNzU5MDQxMjQ0LCJleHAiOjE3NTkwNDQ4NDQsIm5iZiI6MTc1OTA0MTI0NCwianRpIjoiVkJKR3UyT2lDRmtZdU9qUSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.F7uLmRhRZ71tij1v5u9AGh4ZhwI2vvcWa2iSvvDGW9I'),
                new OAT\Property(property: 'token_type', type: 'string', example: 'bearer'),
                new OAT\Property(property: 'expires_in', type: 'integer', example: 3600),
                ])),
]
#[OAT\Schema(
    schema: "BranchRequirements",
    description: "Требования и прогресс ветки",
    properties: [
        new OAT\Property(property: "role", ref: "#/components/schemas/Role", description: "Требуемая роль"),
        new OAT\Property(property: "experience", type: "integer", description: "Требуемый опыт", example: 1000),
        new OAT\Property(
            property: "branches",
            type: "array",
            description: "Зависимые ветки с прогрессом",
            items: new OAT\Items(
                properties: [
                    new OAT\Property(property: "branch_requirement_id", type: "integer", example: 2),
                    new OAT\Property(property: "branch_name", type: "string", example: "Ветка 2"),
                    new OAT\Property(property: "total_missions", type: "integer", example: 5),
                    new OAT\Property(property: "completed_missions", type: "integer", example: 3),
                    new OAT\Property(property: "is_completed", type: "boolean", example: false),
                    new OAT\Property(property: "progress_percent", type: "integer", example: 60),
                    new OAT\Property(property: "status_display", type: "string", example: "В процессе (3/5)"),
                ]
            )
        ),
        new OAT\Property(
            property: "missions",
            type: "array",
            description: "Миссии с статусом выполнения",
            items: new OAT\Items(
                properties: [
                    new OAT\Property(property: "id", type: "integer", example: 1),
                    new OAT\Property(property: "name", type: "string", example: "Миссия 1"),
                    new OAT\Property(property: "description", type: "string", example: "Описание миссии"),
                    new OAT\Property(property: "status_mission", type: "string", example: "Завершено"),
                    new OAT\Property(property: "is_completed", type: "boolean", example: true),
                ]
            )
        ),
    ]
)]
final class ApiResponse
{
    
}
