<?php

declare(strict_types=1);

namespace App\Http\Contracts\Queries;

use App\Http\DTO\CityDTO;
use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CityQuery
{
    public function getAll(CityDTO $DTO): LengthAwarePaginator;
    public function findById(int $id): City;
}
