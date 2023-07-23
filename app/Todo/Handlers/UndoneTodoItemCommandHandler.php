<?php

namespace App\Todo\Handlers;

use App\Events\TodoWasUndone;
use App\Todo\Commands\UndoneTodoItem;

final class UndoneTodoItemCommandHandler
{
    public function handle(UndoneTodoItem $command): void
    {
        $command->item->is_done = false;
        $command->item->save();
        event(TodoWasUndone::forItem($command->item));
    }
}
