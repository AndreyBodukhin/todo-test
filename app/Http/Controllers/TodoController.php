<?php

namespace App\Http\Controllers;

use App\Todo\Handlers\CreateTodoItemCommandHandler;
use App\Todo\Models\TodoItem;
use App\Todo\Requests\TodoImageRequest;
use App\Todo\Requests\TodoItemRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class TodoController extends Controller
{
    private const COUNT_PER_PAGE = 10;
    private const PAGE_PARAMETER_NAME = 'page';

    public function index(Request $request): View
    {
        $items = TodoItem::query()
            ->where('user_id', Auth()->id())
            ->orderByDesc('id')
            ->paginate(
                perPage: self::COUNT_PER_PAGE,
                pageName: self::PAGE_PARAMETER_NAME,
                page: $request->get(self::PAGE_PARAMETER_NAME) ?: 1,

            );
        return view('todo', [
            'items' => $items
        ]);
    }

    public function store(TodoItemRequest $request, CreateTodoItemCommandHandler $command): JsonResponse
    {
        return response()->json($command->handle($request->getCommand()));
    }

    public function uploadImage(TodoImageRequest $request, TodoItem $item,)
    {
        // TODO: Gate can upload
    }

    public function update(TodoItemRequest $request, TodoItem $todoItem)
    {
        // TODO: Gate can update

    }

    public function destroy(TodoItem $todoItem)
    {
        // TODO: Gate can delete
    }
}
