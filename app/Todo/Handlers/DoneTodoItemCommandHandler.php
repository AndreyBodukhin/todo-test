<?php

namespace App\Todo\Handlers;

use App\Events\TodoWasDone;
use App\Todo\Commands\DoneTodoItemCommand;

final class DoneTodoItemCommandHandler
{
    public function handle(DoneTodoItemCommand $command): void
    {
        $command->item->is_done = true;
        $command->item->save();
        event(TodoWasDone::forItem($command->item));
    }
}
