<?php

declare(strict_types=1);

namespace App\Http\Queries;

use App\Http\Contracts\Queries\UserQuery as UserQueryContract;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class UserQuery implements UserQueryContract
{
    public function findById(int $id): User
    {
        return User::where('id', $id)->firstOrFail();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)
            ->first();
    }

    public function getAll(int $limit, int $page): LengthAwarePaginator
    {
        return User::query()
            ->orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);
    }
}
