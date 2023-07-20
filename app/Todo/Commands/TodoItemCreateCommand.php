<?php

namespace App\Todo\Commands;

final class TodoItemCreateCommand
{
    public function __construct(
        readonly int $userId,
        readonly string $text
    )
    {
    }
}
