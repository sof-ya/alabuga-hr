<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
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
