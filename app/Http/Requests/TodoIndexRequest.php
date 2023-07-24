<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class TodoIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tags' => ['array'],
            'tags.*' => ['string'],
            'q' => ['string']
        ];
    }
}
