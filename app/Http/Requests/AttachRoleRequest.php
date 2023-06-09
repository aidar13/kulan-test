<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AttachRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'roleId' => ['required', 'exists:roles,id'],
        ];
    }
}
