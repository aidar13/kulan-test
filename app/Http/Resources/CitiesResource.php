<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Exception;

final class CitiesResource extends BaseResourceCollection
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
           'data' => CityResource::collection($this->resource)
        ];
    }
}
