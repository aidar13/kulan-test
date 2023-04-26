<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\DTO\CreateApplicationDTO;
use Illuminate\Foundation\Http\FormRequest;

final class CreateApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'takeDate'        => ['required', 'date_format:Y-m-d'],
            'whereCityId'     => ['required', 'integer', 'exists:cities,id'],
            'toCityId'        => ['required', 'integer', 'exists:cities,id'],
            'senderAddress'   => ['required'],
            'receiverAddress' => ['required']
        ];
    }

    public function getDTO(): CreateApplicationDTO
    {
        return CreateApplicationDTO::fromRequest($this);
    }
}
