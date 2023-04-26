<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @OA\Schema(
 *     @OA\Property(
 *         property="token_type",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="expires_in",
 *         type="number",
 *     ),
 *     @OA\Property(
 *         property="access_token",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="refresh_token",
 *         type="string",
 *     ),
 * )
 * @property PersonalAccessToken $resource
 */
class TokenResource extends BaseJsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'access_token'  => $this->resource->token,
            'token_type'    => 'Bearer',
            'refresh_token' => '',
            'expires_in'    => Carbon::parse(
                $this->resource->expires_at
            )->toDateTimeString()
        ];
    }
}
