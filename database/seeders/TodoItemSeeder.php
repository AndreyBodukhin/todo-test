<?php

namespace Database\Seeders;

use App\Todo\Models\TodoItem;
use Illuminate\Database\Seeder;

class TodoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TodoItem::factory()->count(50)->create();
    }
}
