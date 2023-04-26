<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Application;
use Exception;

/**
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="takeDate", type="string", example="2023-04-28"),
 *     @OA\Property(property="senderAddress", type="string", example="Астана пр. Республика 34а"),
 *     @OA\Property(property="receiverAddress", type="string", example="Алматы пр Абая 101"),
 *     @OA\Property(property="createdAt", type="string", example="2023-04-27 00:21:56"),
 *     @OA\Property(property="senderCity", type="object", ref="#/components/schemas/CityResource")
 *     @OA\Property(property="receiverCity", type="object", ref="#/components/schemas/CityResource")
 *     @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource")
 *     @OA\Property(property="status", type="object", ref="#/components/schemas/DictionaryResource")
 * )
 *
 * @property Application $resource
 */
final class ApplicationResource extends BaseJsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            'id'              => $this->resource->id,
            'takeDate'        => $this->resource->take_date,
            'senderAddress'   => $this->resource->sender_address,
            'receiverAddress' => $this->resource->receiver_address,
            'createdAt'       => $this->resource->created_at->toDateTimeString(),
            'senderCity'      => new CityResource($this->resource->fromCity),
            'receiverCity'    => new CityResource($this->resource->toCity),
            'user'            => new UserResource($this->resource->user),
            'status'          => new DictionaryResource($this->resource->status),
        ];
    }
}
