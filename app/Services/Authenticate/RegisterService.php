<?php

namespace App\Services\Authenticate;

use App\Http\Requests\RegisterRequest;
use App\Repositories\Authenticate\RegisterRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    protected RegisterRepository $repository;

    public function __construct(RegisterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function userRegister(RegisterRequest $request): array
    {
        $attributes = $this->getAttributesFromRequest($request);
        $user = $this->repository->userRegister($attributes);
        return $this->getUserAttributes($user);
    }

    protected function getAttributesFromRequest(RegisterRequest $request): array
    {
        return [
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "avatar" => "default.jpg"
        ];
    }

    protected function getUserAttributes(Model $user): array
    {
        return [
            'name' => $user->name,
            'username' => $user->username,
            'avatar' => $user->avatar,
            'token' => $this->createSanctumToken($user)
        ];
    }

    protected function createSanctumToken(Model $user): string
    {
        $token = $user->createToken('token');
        return $token->plainTextToken;
    }
}
