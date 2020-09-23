<?php

namespace App\Repositories\Database;

use App\Models\User;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = User::class;
}