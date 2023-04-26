<?php

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Requests\ApplicationShowRequest;

final class ApplicationDTO
{
    public int $limit;
    public int $page;
    public ?int $statusId;
    public ?int $fromCityId;
    public ?int $toCityId;
    public ?string $takeDate;


    public static function fromRequest(ApplicationShowRequest $request): ApplicationDTO
    {
        $self             = new self();
        $self->page       = (int)$request->get('page', 1);
        $self->limit      = (int)$request->get('limit', 20);
        $self->statusId   = $request->has('statusId') ? (int)$request->get('statusId') : null;
        $self->fromCityId = $request->has('fromCityId') ? (int)$request->get('fromCityId') : null;
        $self->toCityId   = $request->has('toCityId') ? (int)$request->get('toCityId') : null;
        $self->takeDate   = $request->get('takeDate');

        return $self;
    }
}
