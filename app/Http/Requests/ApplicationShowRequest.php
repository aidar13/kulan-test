<?php

namespace App\Http\Requests;

use App\Http\DTO\ApplicationDTO;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit'      => ['nullable', 'integer'],
            'page'       => ['nullable', 'integer'],
            'statusId'   => ['nullable', 'exists:dictionaries,id'],
            'fromCityId' => ['nullable', 'exists:cities,id'],
            'toCityId'   => ['nullable', 'exists:cities,id'],
            'takeDate'   => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    public function getDTO(): ApplicationDTO
    {
        return ApplicationDTO::fromRequest($this);
    }
}
