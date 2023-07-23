<?php

namespace App\Todo\Handlers;

use App\Todo\Commands\CreateTodoItem;
use App\Todo\DTO\TodoItemDTO;
use App\Todo\Models\TodoItem;

final class CreateTodoItemCommandHandler
{
    public function handle(CreateTodoItem $command): TodoItemDTO
    {
        /** @var TodoItem $item */
        ($item = TodoItem::query()->create([
            'user_id' => $command->userId,
            'text' => $command->text
        ]))->save();
        return new TodoItemDTO($item->getKey(), $item->text);
    }
}
