<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserQuery
{
    public function findById(int $id): User;

    public function findByEmail(string $email): ?User;

    public function getAll(int $limit, int $page): LengthAwarePaginator;
}
