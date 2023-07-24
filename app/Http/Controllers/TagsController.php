<?php

namespace App\Http\Controllers;

use App\Todo\Commands\Tag\AddTag;
use App\Todo\Commands\Tag\DeleteTag;
use App\Todo\Handlers\Tag\AddTagCommandHandler;
use App\Todo\Handlers\Tag\DeleteTagCommandHandler;
use App\Todo\Handlers\Tag\Exceptions\TagNotFoundException;
use App\Todo\Models\TodoItem;
use App\Todo\Requests\Tag\CreateTagRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class TagsController extends Controller
{
    public function index(TodoItem $item): View
    {
        return view('todo-tags', [
            'tags' => $item->tags,
            'itemId' => $item->id
        ]);
    }

    public function store(
        CreateTagRequest     $request,
        TodoItem             $item,
        AddTagCommandHandler $handler
    ): RedirectResponse
    {
        $handler->handle(
            new AddTag($item, $request->getTagText())
        );
        return back();
    }

    public function destroy(
        TodoItem                $item,
        int                     $tagId,
        DeleteTagCommandHandler $handler
    ): RedirectResponse
    {
        try {
            $handler->handle(new DeleteTag($item, $tagId));
        } catch (TagNotFoundException $e) {
            abort(404);
        }
        return back();
    }
}
