<?php

namespace Database\Seeders;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5; $i++) { 
            Topic::create([
                'title' => "Тестовый топик $i",
                'description' => "Офигенный тестовый топик",
                'author_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
