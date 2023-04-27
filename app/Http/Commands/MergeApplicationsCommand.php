<?php

declare(strict_types=1);

namespace App\Http\Commands;

final class MergeApplicationsCommand
{
    public function __construct(public array $applicationIds) {
    }
}
