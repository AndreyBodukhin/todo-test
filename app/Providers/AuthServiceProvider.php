<?php

namespace App\Providers;

use App\Models\User;
use App\Todo\Models\TodoItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        Gate::define(
            'todo.edit',
            static fn(User $user, TodoItem $item) => $user->getKey() === $item->user_id
        );
        Gate::define(
            'todo.delete',
            static function(User $user, TodoItem $item) {
                return $user->getKey() === $item->user_id;
            }
        );
        Gate::define(
            'todo.done-undone',
            static fn(User $user, TodoItem $item) => $user->getKey() === $item->user_id
        );
    }
}
