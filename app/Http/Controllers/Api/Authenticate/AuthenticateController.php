<?php

namespace App\Http\Controllers\Api\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Authenticate\LoginService;
use App\Services\Authenticate\RegisterService;
use Illuminate\Http\JsonResponse;

class AuthenticateController extends Controller
{
    public function register(RegisterRequest $request, RegisterService $service): JsonResponse
    {
        return response()->json($service->userRegister($request));
    }

    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        return response()->json($service->login($request));
    }
}
