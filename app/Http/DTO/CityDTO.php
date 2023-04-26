<?php

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Requests\CityRequest;

final class CityDTO
{
    public ?int $countryId;
    public int $limit;
    public int $page;

    public static function fromRequest(CityRequest $request): CityDTO
    {
        $self            = new self();
        $self->countryId = $request->has('countryId') ? (int)$request->get('countryId') : null;
        $self->page      = (int)$request->get('page', 1);
        $self->limit     = (int)$request->get('limit', 20);

        return $self;
    }
}
