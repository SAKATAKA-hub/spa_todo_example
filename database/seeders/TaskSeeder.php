<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/*
 | ===================================
 |  タスク　シーダー
 | ===================================
 */
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Task::factory()->count(10)->create();
    }
}
