<?php

namespace App\Todo\Queries;

final class TodoQuery
{
    public function __construct(
        public readonly int     $userId,
        public readonly ?array   $tags,
        public readonly ?string $searchString
    )
    {
    }
}
