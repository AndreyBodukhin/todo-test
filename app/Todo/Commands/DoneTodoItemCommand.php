<?php

namespace App\Todo\Commands;

use App\Todo\Models\TodoItem;

final class DoneTodoItemCommand
{
    public function __construct(
        public readonly TodoItem $item
    )
    {
    }
}
