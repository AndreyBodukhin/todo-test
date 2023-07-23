<?php

namespace App\Todo\Commands\Tag;

use App\Todo\Models\TodoItem;

final class DeleteTagCommand
{
    public function __construct(
        readonly TodoItem $item,
        readonly int $tagId
    )
    {
    }
}

