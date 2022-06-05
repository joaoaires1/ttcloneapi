<?php

namespace App\Http\Controllers\Api\Profile;


use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\SearchRequest;
use App\Services\Profile\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController
{
    private ProfileService $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function search(SearchRequest $request): JsonResponse
    {
        return response()->json($this->service->search($request));
    }

    public function edit(EditProfileRequest $request): JsonResponse
    {
        return response()->json($this->service->edit($request));
    }
}
