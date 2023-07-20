<?php

namespace App\Todo\DTO;

final class TodoItemDTO
{
    public function __construct(
        readonly int $id,
        readonly string $text
    )
    {
    }
}
