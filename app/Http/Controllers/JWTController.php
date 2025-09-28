<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OAT;

class JWTController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

     #[OAT\Post(
                path: '/api/auth/login',
                description: 'Get a JWT via given credentials.',
                requestBody: new OAT\RequestBody(
                        required: true,
                        content: new OAT\JsonContent(required: ['email', 'password'], properties: [
                            new OAT\Property(property: 'email', type: 'string', format: 'email', example: 'test@example.com'),
                            new OAT\Property(property: 'password', type: 'string', format: 'password', example: 'password'),
                                ]),
                ),
                tags: ['auth'],
                responses: [                    
                    new OAT\Response('#/components/responses/TokenResponse', JsonResponse::HTTP_OK),
                    new OAT\Response('#/components/responses/ValidationErrorsResponse', JsonResponse::HTTP_UNPROCESSABLE_ENTITY),
                ],
        )]

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    #[OAT\Post(
            path: '/api/auth/me',
            description: 'Get the authenticated User.',
            tags: ['auth'],
            security: [["JWT" => []]],
            responses: [
                new OAT\Response('#/components/responses/ErrorResponse', JsonResponse::HTTP_UNAUTHORIZED),
                new OAT\Response(response: JsonResponse::HTTP_OK, description: 'User', content: new OAT\JsonContent(ref: '#/components/schemas/User')),
            ],
        )]
    public function me()
    {
        return response()->json(auth()->user());
    }

    #[OAT\Post(
        path: '/api/auth/logout',
        description: 'Log the user out (Invalidate the token).',
        tags: ['auth'],
        security: [["JWT" => []]],
        responses: [
            new OAT\Response('#/components/responses/MessageResponse', JsonResponse::HTTP_OK),
            new OAT\Response('#/components/responses/ErrorResponse', JsonResponse::HTTP_UNAUTHORIZED),
            ],
        )]

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    #[OAT\Post(
            path: '/api/auth/refresh',
            description: 'Refresh a token.',
            tags: ['auth'],
            security: [["JWT" => []]],
            responses: [
                new OAT\Response('#/components/responses/TokenResponse', JsonResponse::HTTP_OK),
                new OAT\Response('#/components/responses/ErrorResponse', JsonResponse::HTTP_UNAUTHORIZED),
            ],
    )]
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}