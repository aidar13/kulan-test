<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Country;
use Exception;

/**
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="name", type="string", example="Kazakstan"),
 * )
 *
 * @property Country $resource
 */
final class CountryResource extends BaseJsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {

        return [
            'id'   => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
