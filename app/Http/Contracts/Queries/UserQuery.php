<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Models\User;

interface UserQuery
{
    public function findByEmail(string $email): ?User;
}
