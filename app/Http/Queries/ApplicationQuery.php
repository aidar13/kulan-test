<?php

declare(strict_types=1);

namespace App\Http\Queries;

use App\Http\Contracts\Queries\ApplicationQuery as ApplicationQueryContract;
use App\Http\DTO\ApplicationDTO;
use App\Models\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final class ApplicationQuery implements ApplicationQueryContract
{
    public function findById(int $id): Application
    {
        return Application::firstOrFail('id', $id);
    }

    public function getAll(ApplicationDTO $DTO): LengthAwarePaginator
    {
        return Application::query()
            ->when($DTO->takeDate, fn($query) => $query->where('take_date', $DTO->takeDate))
            ->when($DTO->fromCityId, fn($query) => $query->where('from_city_id', $DTO->fromCityId))
            ->when($DTO->toCityId, fn($query) => $query->where('to_city_id', $DTO->toCityId))
            ->when($DTO->statusId, fn($query) => $query->where('status_id', $DTO->statusId))
            ->orderBy('id', 'desc')
            ->paginate($DTO->limit, ['*'], 'page', $DTO->page);
    }

    public function getByIds(array $applicationIds): Collection
    {
        return Application::query()
            ->whereIn('id', $applicationIds)
            ->get();
    }
}
