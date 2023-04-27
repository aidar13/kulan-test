<?php

declare(strict_types=1);

namespace App\Http\Commands;

final class RejectApplicationCommand
{
    public function __construct(public int $id) {
    }
}
