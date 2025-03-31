<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class NumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Numbers category
        $category = Category::create([
            'name' => 'Nombres et Chiffres',
            'description' => 'Apprendre les nombres et leurs couleurs',
        ]);

        $numbers = [
            [
                'file' => 'zero orange.png',
                'number' => 'zéro',
                'color' => 'orange',
            ],
            [
                'file' => 'yellow one .png',
                'number' => 'un',
                'color' => 'jaune',
            ],
            [
                'file' => 'green two.png',
                'number' => 'deux',
                'color' => 'vert',
            ],
            [
                'file' => 'blue three.png',
                'number' => 'trois',
                'color' => 'bleu',
            ],
            [
                'file' => 'red four.png',
                'number' => 'quatre',
                'color' => 'rouge',
            ],
            [
                'file' => 'orange five.png',
                'number' => 'cinq',
                'color' => 'orange',
            ],
            [
                'file' => 'yellow six.png',
                'number' => 'six',
                'color' => 'jaune',
            ],
            [
                'file' => 'green seven.png',
                'number' => 'sept',
                'color' => 'vert',
            ],
            [
                'file' => 'blue eight.png',
                'number' => 'huit',
                'color' => 'bleu',
            ],
            [
                'file' => 'red nine.png',
                'number' => 'neuf',
                'color' => 'rouge',
            ],
        ];

        foreach ($numbers as $number) {
            // Create media entry for each number
            $media = Media::create([
                'category_id' => $category->id,
                'type' => 'image',
                'file_path' => 'sample/numbers/'.$number['file'],
                'description' => '',
            ]);

            // Create quiz for the number name
            $allNumbers = ['zéro', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
            $otherNumbers = array_filter($allNumbers, fn ($n) => $n !== $number['number']);
            $randomNumbers = array_rand(array_flip($otherNumbers), 3);
            $options = array_merge([$number['number']], $randomNumbers);
            shuffle($options);

            Quiz::create([
                'category_id' => $category->id,
                'media_id' => $media->id,
                'question' => 'Quel est ce numéro?',
                'options' => json_encode($options),
                'correct_option' => array_search($number['number'], $options),
            ]);

            // Create quiz for the color
            Quiz::create([
                'category_id' => $category->id,
                'media_id' => $media->id,
                'question' => 'De quelle couleur est ce numéro?',
                'options' => json_encode(['orange', 'jaune', 'vert', 'bleu', 'rouge']),
                'correct_option' => match ($number['color']) {
                    'orange' => 0,
                    'jaune' => 1,
                    'vert' => 2,
                    'bleu' => 3,
                    'rouge' => 4,
                },
            ]);
        }
    }
}
