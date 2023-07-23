<?php

namespace App\Todo\Commands;

use App\Todo\Models\TodoItem;

final class DoneTodoItem
{
    public function __construct(
        public readonly TodoItem $item
    )
    {
    }
}
