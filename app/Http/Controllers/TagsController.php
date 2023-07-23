<?php

namespace App\Http\Controllers;

use App\Todo\Commands\Tag\DeleteTagCommand;
use App\Todo\Handlers\Tag\DeleteTagCommandHandler;
use App\Todo\Handlers\Tag\Exceptions\TagNotFoundException;
use App\Todo\Models\TodoItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class TagsController extends Controller
{
    public function index(TodoItem $item): View
    {
        return view('todo-tags', ['tags' => $item->tags, 'item_id' => $item->id]);
    }

    public function store()
    {
        
    }

    public function destroy(
        TodoItem                $item,
        int                     $tagId,
        DeleteTagCommandHandler $handler
    ): RedirectResponse
    {
        try {
            $handler->handle(new DeleteTagCommand($item, $tagId));
        } catch (TagNotFoundException $e) {
            abort(404);
        }
        return back();
    }
}
