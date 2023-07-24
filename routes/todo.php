<?php

use App\Http\Controllers\TagsController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::controller(TodoController::class)
    ->prefix('todo')
    ->middleware(['auth', 'verified'])
    ->group(static function () {
        Route::get('/', 'index')->name('todo');
        Route::post('/', 'store');

        Route::prefix('/{item}')->group(static function() {
            Route::post('/upload-image', 'uploadImage')
                ->middleware('can:todo.edit,item');

            Route::get('/done', 'done')
                ->middleware('can:todo.done-undone,item');

            Route::get('/undone', 'undone')
                ->middleware('can:todo.done-undone,item');

            Route::delete('', 'destroy')
                ->middleware('can:todo.delete,item')
                ->name('todo.destroy');
        });
    });

Route::controller(TagsController::class)
    ->prefix('/todo/{item}/tags')
    ->name('todo.tags')
    ->middleware(['auth', 'verified'])
    ->middleware('can:todo.edit,item')
    ->group(static function () {
        Route::get('', 'index');
        Route::post('', 'store')->name('.store');
        Route::delete('/{tag}', 'destroy')->name('.destroy');
    });
