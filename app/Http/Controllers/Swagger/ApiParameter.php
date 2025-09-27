<?php

namespace App\Http\Controllers\Swagger;

use OpenApi\Attributes as OAT;

#[OAT\Parameter(
    parameter: 'id',
    name: 'id',
    in: 'path',
    required: true,
    schema: new OAT\Schema(type: 'integer', format: 'int64', minimum: 1),
), OAT\Parameter(
    parameter: 'page',
    name: 'page',
    in: 'query',
    required: false,
    schema: new OAT\Schema(type: 'integer', minimum: 1, nullable: true),
),
OAT\Parameter(
    parameter: 'per_page',
    name: 'per_page',
    in: 'query',
    required: false,
    schema: new OAT\Schema(type: 'integer', minimum: -1, nullable: true),
), OAT\Parameter(
    parameter: 'in_storage',
    name: 'in_storage',
    in: 'query',
    required: false,
    schema: new OAT\Schema(type: 'integer', enum: [1, 0]),
), OAT\Parameter(
    parameter: 'only_available',
    name: 'only_available',
    in: 'query',
    required: false,
    schema: new OAT\Schema(type: 'integer', enum: [1, 0]),
),


] final readonly class ApiParameter
{
}
