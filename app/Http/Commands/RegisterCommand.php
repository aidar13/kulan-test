<?php

declare(strict_types=1);

namespace App\Http\Commands;

use App\Http\DTO\RegisterDTO;

final class RegisterCommand
{
    public function __construct(public RegisterDTO $DTO) {
    }
}
