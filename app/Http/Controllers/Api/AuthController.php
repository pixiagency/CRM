<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    /**
     * Handle user signup.
     */
    public function signup(SignupRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->signup(
                name: $request->name,
                email: $request->email,
                password: $request->password
            );

            return apiResponse($user, trans('app.signup_successfully'), 201);
        } catch (Exception $e) {
            return apiResponse(null, $e->getMessage(), 500);
        }
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            // Authenticate user
            $user = $this->authService->loginWithEmailOrPhone(
                identifier: $request->identifier,
                password: $request->password
            );

            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            return apiResponse([
                'token' => $token,
                'user' => $user
            ], trans('app.login_successfully'), 200);

        } catch (NotFoundException $e) {
            return apiResponse(null, $e->getMessage(), 401);
        } catch (Exception $e) {
            return apiResponse(null, $e->getMessage(), 500);
        }
    }

    /**
     * Handle user logout.
     */
    public function logout(): JsonResponse
    {
        try {
            $user = Auth::user();
            $user?->tokens()->delete(); // Revoke all tokens
            return apiResponse(null, trans('app.logout_successfully'), 200);
        } catch (Exception $e) {
            return apiResponse(null, 'Logout failed', 500);
        }
    }
}
