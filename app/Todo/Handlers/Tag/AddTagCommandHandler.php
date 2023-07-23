<?php

namespace App\Todo\Handlers\Tag;

use App\Todo\Commands\Tag\AddTagCommand;

final class AddTagCommandHandler
{
    public function handle(AddTagCommand $command): void
    {
        $command->item->tag($command->tag);
    }
}
