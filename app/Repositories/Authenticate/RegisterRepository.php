<?php

namespace App\Repositories\Authenticate;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class RegisterRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function userRegister(array $attributes): Model
    {
        return $this->create($attributes);
    }
}
