<?php

declare(strict_types=1);

namespace App\Http\Commands;

final class AttachRoleCommand
{
    public function __construct(
        public int $userId,
        public int $roleId
    ) {
    }
}
