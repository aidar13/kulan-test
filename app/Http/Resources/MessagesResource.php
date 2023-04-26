<?php

declare(strict_types=1);

namespace App\Http\Resources;

final class MessagesResource extends BaseJsonResource
{
    /**
     * @param $request
     * @return null[]
     */
    public function toArray($request): array
    {
        return [
            'data' => null
        ];
    }
}
