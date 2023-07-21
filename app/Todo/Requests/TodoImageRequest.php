<?php

namespace App\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class TodoImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }

    public function getImage(): UploadedFile
    {
        return $this->file('image');
    }
}
