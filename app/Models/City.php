<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property-read Country $country
 */
class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
