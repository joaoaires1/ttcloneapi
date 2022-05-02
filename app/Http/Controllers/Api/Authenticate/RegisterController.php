<?php

namespace App\Http\Controllers\Api\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Authenticate\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request, RegisterService $service): JsonResponse
    {
        $register = $service->userRegister($request);
        return response()->json($register);
    }
}
