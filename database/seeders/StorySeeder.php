<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use Illuminate\Support\Facades\DB;

class StorySeeder extends Seeder
{
    public function run()
    {
        $stories = [
            [
                'title' => 'Your Story Title 1',
                'content' => 'Your Story Content 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Your Story Title 2',
                'content' => 'Your Story Content 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('stories')->insert($stories);
    }
} 