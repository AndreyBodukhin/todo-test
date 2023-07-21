<?php

namespace App\Events;

use App\Todo\Models\TodoItem;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TodoWasUndone
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly int $itemId
    )
    {
    }

    public static function forItem(TodoItem $item): TodoWasUndone
    {
        return new self($item->id);
    }
}
