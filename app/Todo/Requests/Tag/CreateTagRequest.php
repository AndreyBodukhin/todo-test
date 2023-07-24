<?php

namespace App\Todo\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tag' => ['required', 'min:1', 'max:20']
        ];
    }

    public function getTagText(): string
    {
        return (string)$this->request->get('tag');
    }
}
