<?php

namespace App\Todo\Handlers;

use App\Todo\Commands\DeleteTodoItem;

final class DeleteTodoItemCommandHandler
{
    public function handle(DeleteTodoItem $command): void
    {
        $command->item->delete();
    }
}
