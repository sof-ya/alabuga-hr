<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;
use OpenApi\Attributes as OAT;

class AuthController extends Controller
{
    #[OAT\Post(
        path: '/api/auth/login',
        description: 'Get token.',
        requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(required: ['email', 'password'], properties: [
                    new OAT\Property(property: 'email', type: 'string', format: 'email', example: 'test@example.com'),
                    new OAT\Property(property: 'password', type: 'string', format: 'password', example: 'password'),
                        ]),
        ),
        tags: ['auth'],
        responses: [
            new OAT\Response('', JsonResponse::HTTP_OK),
            new OAT\Response('', JsonResponse::HTTP_UNPROCESSABLE_ENTITY),
        ],

    )]
    public function login() : JsonResponse {
        $credentials = request(['email', 'password']);

        if(Auth::attempt($credentials)) {
            $token = request()->user()->createToken('Personal Access Token');

            return $this->respondWithToken($token);
        };

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);

    }

    public function me(): JsonResponse
    {
        return response()->json(auth('sanctum')->user());
    }

    protected function respondWithToken(NewAccessToken $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token->plainTextToken,
        ]);
    }

}
