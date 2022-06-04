<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storePost(StorePostRequest $request, PostService $service): JsonResponse
    {
        return response()->json($service->storePost($request));
    }
    public function getPosts(Request $request): JsonResponse
    {
        return response()->json([]);
    }
}
