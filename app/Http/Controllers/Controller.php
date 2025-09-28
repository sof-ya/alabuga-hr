<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OAT;

#[OAT\Info(title: 'API', version: '1.0.0')]
abstract class Controller extends BaseController
{   
    use AuthorizesRequests, ValidatesRequests;
    
    protected function validatedPaginator(Request $request): ?array
    {
        return validator([
            'page' => $request->query('page'),
            'perPage' => $request->query('per_page'),
            'query' => $request->query('query'),
                ], [
            'page' => ['nullable', 'integer', 'min:1'],
            'perPage' => ['nullable', 'integer', 'min:-1'],
        ])->validated();
    }

}
