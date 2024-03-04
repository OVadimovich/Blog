<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
