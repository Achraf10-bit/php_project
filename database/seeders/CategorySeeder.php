<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Images category
        $imagesCategory = Category::create([
            'name' => 'Images',
            'description' => 'A collection of sample images',
        ]);

        Media::create([
            'category_id' => $imagesCategory->id,
            'type' => 'image',
            'file_path' => 'sample/image1.jpg',
        ]);

        // Create Videos category
        $videosCategory = Category::create([
            'name' => 'Videos',
            'description' => 'A collection of sample videos',
        ]);

        Media::create([
            'category_id' => $videosCategory->id,
            'type' => 'video',
            'file_path' => 'sample/video1.mp4',
        ]);

        // Create Audio category
        $audioCategory = Category::create([
            'name' => 'Audio',
            'description' => 'A collection of sample audio files',
        ]);

        Media::create([
            'category_id' => $audioCategory->id,
            'type' => 'audio',
            'file_path' => 'sample/audio1.mp3',
        ]);
    }
}
