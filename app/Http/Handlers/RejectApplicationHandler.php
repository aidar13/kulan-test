<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\RejectApplicationCommand;
use App\Http\Contracts\Queries\ApplicationQuery;
use App\Models\Application;

final class RejectApplicationHandler
{
    public function __construct(private readonly ApplicationQuery $applicationQuery)
    {
    }

    public function handle(RejectApplicationCommand $command): void
    {
        $application = $this->applicationQuery->findById($command->id);
        $application->setStatus(Application::STATUS_ID_REJECTED);
        $application->save();
    }
}
