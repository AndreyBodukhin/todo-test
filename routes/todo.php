<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::controller(TodoController::class)
    ->prefix('todo')
    ->middleware(['auth', 'verified'])
    ->group(static function () {
        Route::get('/', 'index')->name('todo');
        Route::post('/', 'store');

        Route::post('/{item}/upload-image', 'uploadImage')
            ->middleware('can:todo.edit,item');

        Route::get('/{item}/done', 'done')
            ->middleware('can:todo.done-undone,item');

        Route::get('/{item}/undone', 'undone')
            ->middleware('can:todo.done-undone,item');

        Route::delete('/{item}', 'destroy')
            ->middleware('can:todo.delete,item')
            ->name('todo.destroy');
    });
