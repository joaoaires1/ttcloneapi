<?php

namespace App\Services\Follow;

use App\Http\Requests\FollowRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FollowService
{
    public function follow(FollowRequest $request)
    {
        try {
            $userToFollow = $this->getUserByFollowedId($request->followed_id);
            auth()->user()->following()->attach($userToFollow);
            return ['success' => true];
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return ['success' => false];
        }
    }

    public function unfollow(FollowRequest $request)
    {
        try {
            $userToUnFollow = $this->getUserByFollowedId($request->followed_id);
            if ($userToUnFollow)
                auth()->user()->following()->detach($userToUnFollow);
            return ['success' => true];
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return ['success' => false];
        }
    }

    public function getUserByFollowedId(int $followedId): ?User
    {
        return User::find($followedId);
    }
}
