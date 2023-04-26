<?php

namespace App\Http\Requests;

use App\Http\DTO\CityDTO;
use Illuminate\Foundation\Http\FormRequest;

class CityShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit'     => ['nullable', 'integer'],
            'page'      => ['nullable', 'integer'],
            'countryId' => ['nullable', 'exists:countries,id'],
        ];
    }

    public function getDTO(): CityDTO
    {
        return CityDTO::fromRequest($this);
    }
}
