<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       foreach(Topic::all() as $post) {
        Post::create([
            'message' => "Тестовое сообщение ". $post->id,
            'topic_id' => $post->id,
            'author_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       }

        }

    }
