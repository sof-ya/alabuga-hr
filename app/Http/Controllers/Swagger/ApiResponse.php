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
final class ApiResponse
{
    
}
