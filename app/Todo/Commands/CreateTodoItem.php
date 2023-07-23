<?php

namespace App\Todo\Commands;

final class CreateTodoItem
{
    public function __construct(
        readonly int $userId,
        readonly string $text
    )
    {
    }
}
