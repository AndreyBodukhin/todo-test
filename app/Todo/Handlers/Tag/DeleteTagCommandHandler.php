<?php

namespace App\Todo\Handlers\Tag;

use App\Todo\Commands\Tag\DeleteTagCommand;
use App\Todo\Handlers\Tag\Exceptions\TagNotFoundException;
use Exception;

final class DeleteTagCommandHandler
{
    /**
     * @throws TagNotFoundException
     */
    public function handle(DeleteTagCommand $command): void
    {
        $tag = $command->item->tags?->where('id', $command->tagId)?->first();
        if ($tag === null) {
            throw new TagNotFoundException('Not found');
        }
        $command->item->untag($tag->name);
    }
}
