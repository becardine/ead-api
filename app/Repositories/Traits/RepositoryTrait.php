<?php

namespace App\Repositories\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

trait RepositoryTrait
{
    private function getUserAuth(): User
    {
        return auth()->user();
    }
}
