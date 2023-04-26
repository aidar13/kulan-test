<?php

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Requests\CreateApplicationRequest;

final class CreateApplicationDTO
{
    public string $takeDate;
    public int $whereCityId;
    public int $toCityId;
    public string $senderAddress;
    public string $receiverAddress;

    public static function fromRequest(CreateApplicationRequest $request): CreateApplicationDTO
    {
        $self                  = new self();
        $self->takeDate        = $request->get('takeDate');
        $self->whereCityId     = (int)$request->get('whereCityId');
        $self->toCityId        = (int)$request->get('toCityId');
        $self->senderAddress   = $request->get('senderAddress');
        $self->receiverAddress = $request->get('receiverAddress');

        return $self;
    }
}
