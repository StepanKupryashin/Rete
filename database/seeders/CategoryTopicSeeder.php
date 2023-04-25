<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Category::all() as $value) {
            foreach (Topic::all()  as $j) {
                DB::table('categories_topics')->insert([
                    'topic_id' => $j->id,
                    'category_id' => $value->id
                ]);
            }
        }
    }
}
