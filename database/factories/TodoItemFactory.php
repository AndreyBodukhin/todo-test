<?php

namespace Database\Factories;

use App\Models\User;
use App\Todo\Models\TodoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TodoItem>
 */
class TodoItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getFirstUserId(),
            'text' => fake()->text(35),
            'is_done' => fake()->boolean(),
        ];
    }

    /**
     * @return mixed|null
     */
    public function getFirstUserId(): mixed
    {
        static $firstUserId = null;
        return $firstUserId ??= User::all()->first()?->id;
    }
}
