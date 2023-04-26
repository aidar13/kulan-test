<?php

declare(strict_types=1);

namespace App\Http\Queries;

use App\Http\Contracts\Queries\CityQuery as CityQueryContract;
use App\Http\DTO\CityDTO;
use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CityQuery implements CityQueryContract
{
    public function getAll(CityDTO $DTO): LengthAwarePaginator
    {
        return City::query()
            ->when($DTO->countryId, fn($query) => $query->where('country_id', $DTO->countryId))
            ->orderBy('id', 'desc')
            ->paginate($DTO->limit, ['*'], 'page', $DTO->page);
    }
}
