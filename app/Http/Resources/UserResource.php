<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Exception;

/**
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="name", type="string", example="Tomas Muller"),
 *     @OA\Property(property="email", type="string", example="qwe@mail.ru")
 * )
 *
 * @property User $resource
 */
final class UserResource extends BaseJsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            'id'    => $this->resource->id,
            'name'  => $this->resource->name,
            'email' => $this->resource->email,
        ];
    }
}
