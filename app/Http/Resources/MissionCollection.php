<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MissionCollection extends ResourceCollection
{

    protected function preparePaginatedResponse($request)
    {
        return $this->resource;
    }
}

