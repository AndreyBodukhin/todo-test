<?php

namespace Database\Factories;

use App\Models\User;
use App\Todo\Models\TodoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Todo\Models\TodoItem>
 */
class TodoItemFactory extends Factory
{
    protected $model = TodoItem::class;

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

    public function getFirstUserId(): ?int
    {
        static $firstUserId = null;
        return $firstUserId ??= User::all()->first()?->id;
    }
}
