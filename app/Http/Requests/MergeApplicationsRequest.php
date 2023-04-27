<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MergeApplicationsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'applicationIds'   => ['required', 'array'],
            'applicationIds.*' => ['required', 'exists:applications,id']
        ];
    }
}
