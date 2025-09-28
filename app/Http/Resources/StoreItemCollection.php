<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
            required: ['data'],
            properties: [
                new OAT\Property('data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/StoreItemResource')),
            ],
    )]

class StoreItemCollection extends ResourceCollection
{

    protected function preparePaginatedResponse($request)
    {
        return $this->resource;
    }
}
