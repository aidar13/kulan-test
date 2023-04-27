<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use App\Http\Commands\MergeApplicationsCommand;
use App\Http\Contracts\Queries\ApplicationQuery;
use App\Models\Application;
use App\Models\Order;
use Illuminate\Support\Collection;

final class MergeApplicationsHandler
{
    public function __construct(private readonly ApplicationQuery $applicationQuery)
    {
    }

    public function handle(MergeApplicationsCommand $command): void
    {
        $applications = $this->checkApplications($command->applicationIds);

        if (!$applications) {
            return;
        }

        /** @var Application $application */
        $application = $applications->first();

        $order               = new Order();
        $order->take_date    = $application->take_date;
        $order->from_city_id = $application->from_city_id;
        $order->to_city_id   = $application->to_city_id;
        $order->save();

        foreach ($applications as $application) {
            $application->order_id = $order->id;
            $application->setStatus(Application::STATUS_ID_ACCEPTED);
            $application->save();
        }
    }

    private function checkApplications(array $applicationIds): ?Collection
    {
        $applications = $this->applicationQuery->getByIds($applicationIds);

        $uniqueTakeDates      = $applications->unique('take_date')->count();
        $uniqueSenderCities   = $applications->unique('from_city_id')->count();
        $uniqueReceiverCities = $applications->unique('to_city_id')->count();

        if ($uniqueTakeDates > 1 || $uniqueSenderCities > 1 || $uniqueReceiverCities > 1) {
            return null;
        }

        return $applications;
    }
}
