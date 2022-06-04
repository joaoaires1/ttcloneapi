<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function store(array $attributes): Model
    {
        return $this->create($attributes);
    }

    public function getPosts(Request $request): array
    {
        $user = auth()->user();
        $posts = $this->model->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->with('user');

        $currentPage = $request->page ?? 1;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        return $posts->paginate(15)->toArray();
    }
}
