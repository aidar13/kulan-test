<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\AttachRoleCommand;
use App\Http\Contracts\Queries\UserQuery;

final class AttachRoleHandler
{
    public function __construct(private readonly UserQuery $userQuery)
    {
    }

    public function handle(AttachRoleCommand $command): void
    {
        $user = $this->userQuery->findById($command->userId);
        $user->roles()->sync([$command->roleId], false);
    }
}
