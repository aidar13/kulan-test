<?php

declare(strict_types=1);

namespace App\Http\Queries;

use App\Http\Contracts\Queries\UserQuery as UserQueryContract;
use App\Models\User;

final class UserQuery implements UserQueryContract
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)
            ->first();
    }
}
