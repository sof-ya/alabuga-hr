<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
{
    
    protected function preparePaginatedResponse($request)
    {
        return $this->resource;
    }
}

