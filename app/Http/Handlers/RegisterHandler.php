<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\RegisterCommand;
use App\Http\Contracts\Queries\UserQuery;
use App\Http\DTO\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class RegisterHandler
{
    public function __construct(private readonly UserQuery $userQuery)
    {
    }

    public function handle(RegisterCommand $command): ?PersonalAccessToken
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

        return $this->getToken($user, $command->DTO);
    }

    private function getToken(User $user, RegisterDTO $registerDTO): PersonalAccessToken
    {
        $credentials = [
            'email'    => $registerDTO->email,
            'password' => $registerDTO->password
        ];

        if (!Auth::guard('web')->attempt($credentials)) {
            throw new NotFoundHttpException('User not found');
        }

        /** @var User $user */
        $user = Auth::guard('web')->user();

        $tokenResult       = $user->createToken('Personal Access Token')->accessToken;

        $token             = $tokenResult;
        $token->expires_at = Carbon::now()->addDay();
        $token->save();

        return $token;
    }
}
