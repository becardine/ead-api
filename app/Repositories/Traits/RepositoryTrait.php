<?php

namespace App\Repositories\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait RepositoryTrait
{

    /**
     * @return User
     */
    private function getUserAuth():User
    {
        // return auth()->user();
        return User::first();
    }
}
