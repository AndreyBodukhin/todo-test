<?php

namespace App\Todo\Handlers\Tag;

use App\Todo\Commands\Tag\AddTag;

final class AddTagCommandHandler
{
    public function handle(AddTag $command): void
    {
        $command->item->tag($command->tag);
    }
}
