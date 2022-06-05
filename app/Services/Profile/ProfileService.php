<?php

namespace App\Services\Profile;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\Profile\ProfileRepository;

class ProfileService
{
    private ProfileRepository $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(SearchRequest $request): array
    {
        $profiles = $this->repository->search($request->name);
        return $profiles->toArray();
    }

    public function edit(EditProfileRequest $request): array
    {

        $editProfile = $this->repository->edit($request);
        return $editProfile->toArray();
    }
}
