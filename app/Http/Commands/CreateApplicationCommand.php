<?php

declare(strict_types=1);

namespace App\Http\Commands;

use App\Http\DTO\CreateApplicationDTO;

final class CreateApplicationCommand
{
    public function __construct(
        public int $userId,
        public CreateApplicationDTO $DTO
    ) {
    }
}
