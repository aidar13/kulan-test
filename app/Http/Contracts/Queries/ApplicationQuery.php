<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Http\DTO\ApplicationDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ApplicationQuery
{
    public function getAll(ApplicationDTO $DTO): LengthAwarePaginator;
}
