<?php

namespace App\Services\Authenticate;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginService
{
    public string $username;
    public string $password;

    public function login(LoginRequest $request): array
    {
        $this->setPropertiesFromRequest($request);
        if (!Auth::attempt($this->getAttempt()))
            throw new HttpResponseException($this->getResponseError());

        return ['token' => $this->createLoginToken()];
    }

    public function setPropertiesFromRequest(LoginRequest $request): void
    {
        $this->username = $request->username;
        $this->password = $request->password;
    }

    public function getResponseError(): Response
    {
        return response()->json(
            [
                'success' => false,
                'errors' => ['Credentials is not valid.']
            ],
            401
        );
    }

    public function getAttempt(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }

    public function createLoginToken(): string
    {
        return auth()->user()->createToken('token')->plainTextToken;
    }
}
