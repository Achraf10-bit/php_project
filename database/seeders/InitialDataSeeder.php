<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Support\Facades\File;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create placeholder files
        $sampleDir = storage_path('app/public/sample');
        if (!File::exists($sampleDir)) {
            File::makeDirectory($sampleDir, 0755, true);
        }

        // Create a placeholder image
        $imagePath = $sampleDir . '/image1.jpg';
        if (!File::exists($imagePath)) {
            File::put($imagePath, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=='));
        }

        // Create a placeholder audio file
        $audioPath = $sampleDir . '/audio1.mp3';
        if (!File::exists($audioPath)) {
            File::put($audioPath, '');
        }

        // Create a placeholder video file
        $videoPath = $sampleDir . '/video1.mp4';
        if (!File::exists($videoPath)) {
            File::put($videoPath, '');
        }

        // Create Categories with Media
        $categories = [
            [
                'name' => 'Images',
                'description' => 'A collection of sample images',
                'media' => [
                    [
                        'type' => 'image',
                        'file_path' => 'sample/image1.jpg',
                        'description' => 'Sample image'
                    ]
                ]
            ],
            [
                'name' => 'Videos',
                'description' => 'A collection of sample videos',
                'media' => [
                    [
                        'type' => 'video',
                        'file_path' => 'sample/video1.mp4',
                        'description' => 'Sample video'
                    ]
                ]
            ],
            [
                'name' => 'Audio',
                'description' => 'A collection of sample audio files',
                'media' => [
                    [
                        'type' => 'audio',
                        'file_path' => 'sample/audio1.mp3',
                        'description' => 'Sample audio'
                    ]
                ]
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description']
            ]);

            foreach ($categoryData['media'] as $mediaData) {
                Media::create([
                    'category_id' => $category->id,
                    'type' => $mediaData['type'],
                    'file_path' => $mediaData['file_path'],
                    'description' => $mediaData['description']
                ]);
            }
        }
    }
}
