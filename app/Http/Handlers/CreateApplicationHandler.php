<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\CreateApplicationCommand;
use App\Http\Contracts\Queries\CityQuery;
use App\Models\Application;

final class CreateApplicationHandler
{
    public function __construct(private readonly CityQuery $cityQuery)
    {
    }

    public function handle(CreateApplicationCommand $command): void
    {
        $senderCity   = $this->cityQuery->findById($command->DTO->whereCityId);
        $receiverCity = $this->cityQuery->findById($command->DTO->toCityId);

        $application                   = new Application();
        $application->user_id          = $command->userId;
        $application->take_date        = $command->DTO->takeDate;
        $application->from_city_id     = $senderCity->id;
        $application->to_city_id       = $receiverCity->id;
        $application->sender_address   = $command->DTO->senderAddress;
        $application->receiver_address = $command->DTO->receiverAddress;
        $application->setStatus(Application::STATUS_ID_CREATED);
        $application->save();
    }
}
