<?php

namespace App\Repositories\Profile;

use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function search(string $name): Collection
    {
        return $this->model->where('name', 'like', "%$name%")
            ->orWhere('username', 'like', "%$name%")
            ->select('name', 'username', 'avatar')
            ->get();
    }

    public function edit(EditProfileRequest $request): User
    {
        $profile = auth()->user();
        if ($request->photo) {
            $avatar = Str::random(30);
            $profile->avatar = "{$avatar}.jpg";

            $request->file('photo')->move(
                public_path() . '/uploads/avatar',
                "{$avatar}.jpg"
            );
        }
        $profile->name = $request->name;
        $profile->save();

        return $profile;
    }
}
