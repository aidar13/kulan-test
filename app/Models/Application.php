<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property int $status_id
 * @property CarbonImmutable $take_date
 * @property int $from_city_id
 * @property int $to_city_id
 * @property string $sender_address
 * @property string $receiver_address
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 * @property-read User $user
 * @property-read Dictionary $status
 * @property-read City $fromCity
 * @property-read City $toCity
 * @property-read Order $order
 */
class Application extends Model
{
    use HasFactory;

    public const STATUS_ID_CREATED = 1;
    public const STATUS_ID_REJECTED = 2;
    public const STATUS_ID_ACCEPTED = 3;
    public const STATUS_ID_IN_PROGRESS = 4;
    public const STATUS_ID_COMPLETED = 5;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Dictionary::class, 'status_id', 'id');
    }

    public function fromCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city_id', 'id');
    }

    public function toCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function setStatus(int $statusId): void
    {
        $this->status_id = $statusId;
    }
}
