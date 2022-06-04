<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\GetPostsResource;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function storePost(StorePostRequest $request): JsonResponse
    {
        return response()->json($this->service->storePost($request));
    }

    public function getPosts(Request $request): GetPostsResource
    {
        return new GetPostsResource($this->service->getPosts($request));
    }
}
