<?php

namespace App\Todo\Requests;

use App\Todo\Commands\CreateTodoItem;
use Illuminate\Foundation\Http\FormRequest;

final class CreateTodoItemRequest extends FormRequest
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

    public function getCommand(): CreateTodoItem
    {
        return new CreateTodoItem(
            Auth()->id(),
            $this->request->get('text')
        );
    }
}
