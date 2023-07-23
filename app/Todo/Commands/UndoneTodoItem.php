<?php

namespace App\Todo\Commands;

use App\Todo\Models\TodoItem;

final class UndoneTodoItem
{
    public function __construct(
        public readonly TodoItem $item
    )
    {
    }
}
