<?php

namespace Database\Seeders;

use App\Todo\Models\TodoItem;
use Database\Factories\TodoItemFactory;
use Illuminate\Database\Seeder;

class TodoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new TodoItemFactory())->count(50)->create();
    }
}
