<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255']
        ];
    }
}
