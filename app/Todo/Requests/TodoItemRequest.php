<?php

namespace App\Todo\Requests;

use App\Todo\Commands\TodoItemCreateCommand;
use Illuminate\Foundation\Http\FormRequest;

class TodoItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'min:3', 'max:50']
        ];
    }

    public function getCommand(): TodoItemCreateCommand
    {
        return new TodoItemCreateCommand(
            Auth()->id(),
            $this->request->get('text')
        );
    }
}
