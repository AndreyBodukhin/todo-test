<?php

namespace App\Todo\Handlers;

use App\Todo\Models\TodoItem;
use App\Todo\Queries\TodoQuery;
use Illuminate\Database\Eloquent\Builder;

final class TodoQueryHandler
{
    public function handle(TodoQuery $query): Builder
    {
        $itemQuery = TodoItem::query()
            ->where('user_id', $query->userId)
            ->orderByDesc('id');

        if (!empty($query->tags)) {
            $itemQuery->withAllTags($query->tags);
        }

        if (!empty($query->searchString)) {
            $itemQuery->where('text', 'like', "%{$query->searchString}%");
        }

        return $itemQuery;
    }
}
