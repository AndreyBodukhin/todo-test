<?php

namespace App\Todo\Commands\Tag;

use App\Todo\Models\TodoItem;

final class DeleteTag
{
    public function __construct(
        readonly TodoItem $item,
        readonly int $tagId
    )
    {
    }
}

