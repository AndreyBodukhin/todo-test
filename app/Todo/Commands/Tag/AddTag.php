<?php

namespace App\Todo\Commands\Tag;

use App\Todo\Models\TodoItem;

final class AddTag
{
    public function __construct(
        readonly TodoItem $item,
        readonly string $tag
    )
    {
    }
}
