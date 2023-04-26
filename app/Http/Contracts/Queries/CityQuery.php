<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Http\DTO\CityDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CityQuery
{
    public function getAll(CityDTO $DTO): LengthAwarePaginator;
}
