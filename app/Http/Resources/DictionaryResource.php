<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Dictionary;
use Exception;

/**
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="Создан")
 * )
 *
 * @property Dictionary $resource
 */
final class DictionaryResource extends BaseJsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            'id'    => $this->resource->id,
            'title' => $this->resource->title,
        ];
    }
}
