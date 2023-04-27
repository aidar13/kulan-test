<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Http\DTO\ApplicationDTO;
use App\Models\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ApplicationQuery
{
    public function findById(int $id): Application;

    public function getAll(ApplicationDTO $DTO): LengthAwarePaginator;

    public function getByIds(array $applicationIds): Collection;
}
