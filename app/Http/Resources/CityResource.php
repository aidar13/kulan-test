<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\City;
use Exception;

/**
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="name", type="string", example="+77771231212"),
 *     @OA\Property(property="country", type="object", ref="#/components/schemas/CountryResource")
 * )
 *
 * @property City $resource
 */
final class CityResource extends BaseJsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            'id'      => $this->resource->id,
            'name'    => $this->resource->name,
            'country' => new CountryResource($this->resource->country),
        ];
    }
}
