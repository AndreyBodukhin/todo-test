<?php

namespace App\Todo\Commands;

use App\Todo\Models\TodoItem;

final class DeleteTodoItem
{
    public function __construct(
        readonly TodoItem $item
    )
    {
    }
}
