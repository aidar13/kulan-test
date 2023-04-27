<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Exception;

final class UsersResource extends BaseResourceCollection
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
           'data' => UserResource::collection($this->resource)
        ];
    }
}
