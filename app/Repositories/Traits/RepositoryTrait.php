<?php

namespace App\Repositories\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

trait RepositoryTrait
{

    /**
     * @return Authenticatable
     */
    private function getUserAuth(): Authenticatable
    {
        return auth()->user();
    }
}
