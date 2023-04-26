<?php

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Requests\RegisterRequest;

final class RegisterDTO
{
    public string $password;
    public string $email;
    public int $cityId;

    public static function fromRequest(RegisterRequest $request): RegisterDTO
    {
        $self           = new self();
        $self->email    = $request->get('email');
        $self->password = $request->get('password');
        $self->cityId   = (int)$request->get('cityId');

        return $self;
    }
}
