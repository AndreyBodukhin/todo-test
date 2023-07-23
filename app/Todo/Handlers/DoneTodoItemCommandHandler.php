<?php

namespace App\Todo\Handlers;

use App\Events\TodoWasDone;
use App\Todo\Commands\DoneTodoItem;

final class DoneTodoItemCommandHandler
{
    public function handle(DoneTodoItem $command): void
    {
        $command->item->is_done = true;
        $command->item->save();
        event(TodoWasDone::forItem($command->item));
    }
}
