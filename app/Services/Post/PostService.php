<?php

namespace App\Services\Post;

use App\Http\Requests\StorePostRequest;
use App\Repositories\Post\PostRepository;

class PostService
{
    protected PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storePost(StorePostRequest $request): array
    {
        $attributes = $this->getAttributesToStorePost($request);
        $post = $this->repository->store($attributes);
        return $post->toArray();
    }

    public function getAttributesToStorePost(StorePostRequest $request): array
    {
        return [
            'user_id' => auth()->user()->id,
            'text' => $request->text
        ];
    }
}
