<?php

namespace App\Http\Controllers\Api\Follow;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Services\Follow\FollowService;

class FollowController extends Controller
{
    public function follow(FollowRequest $request, FollowService $service)
    {
        return response()->json($service->follow($request));
    }

    public function unfollow(FollowRequest $request, FollowService $service)
    {
        return response()->json($service->unfollow($request));
    }
}
