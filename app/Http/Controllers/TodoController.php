<?php

namespace App\Http\Controllers;

use App\Todo\Commands\DeleteTodoItem;
use App\Todo\Commands\DoneTodoItem;
use App\Todo\Commands\UndoneTodoItem;
use App\Todo\Commands\UploadImage;
use App\Todo\Handlers\CreateTodoItemCommandHandler;
use App\Todo\Handlers\DeleteTodoItemCommandHandler;
use App\Todo\Handlers\DoneTodoItemCommandHandler;
use App\Todo\Handlers\UndoneTodoItemCommandHandler;
use App\Todo\Handlers\UploadImageCommandHandler;
use App\Todo\Models\TodoItem;
use App\Todo\Requests\UploadImageRequest;
use App\Todo\Requests\CreateTodoItemRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function store(
        CreateTodoItemRequest        $request,
        CreateTodoItemCommandHandler $handler
    ): JsonResponse
    {
        return response()->json($handler->handle($request->getCommand()));
    }

    public function uploadImage(
        UploadImageRequest        $request,
        TodoItem                  $item,
        UploadImageCommandHandler $handler
    ): RedirectResponse
    {
        $handler->handle(new UploadImage($item, $request->getImage()));
        return back();
    }

    public function done(TodoItem $item, DoneTodoItemCommandHandler $handler): Response
    {
        $handler->handle(new DoneTodoItem($item));
        return response()->noContent();
    }

    public function undone(TodoItem $item, UndoneTodoItemCommandHandler $handler): Response
    {
        $handler->handle(new UndoneTodoItem($item));
        return response()->noContent();
    }

    public function destroy(TodoItem $item, DeleteTodoItemCommandHandler $handler): RedirectResponse
    {
        $handler->handle(new DeleteTodoItem($item));
        return back();
    }
}
