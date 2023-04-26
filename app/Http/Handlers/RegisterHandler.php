<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\RegisterCommand;
use App\Http\Contracts\Queries\UserQuery;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class RegisterHandler
{
    public function __construct(private readonly UserQuery $userQuery)
    {
    }

    public function handle(RegisterCommand $command): void
    {
        $user = $this->userQuery->findByEmail($command->DTO->email);

        if (!$user) {
            $user           = new User();
            $user->name     = $command->DTO->email;
            $user->email    = $command->DTO->email;
            $user->password = Hash::make($command->DTO->password);
            $user->save();
        }

        $user->cities()->attach($command->DTO->cityId);
    }
}
