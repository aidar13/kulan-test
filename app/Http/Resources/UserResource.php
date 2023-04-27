<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Exception;

/**
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
            'email' => $this->resource->email
        ];
    }
}
