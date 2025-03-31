<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Media;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class NumberQuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Numbers category
        $category = Category::create([
            'name' => 'Nombres et Chiffres',
            'description' => 'Apprendre les nombres et leurs couleurs'
        ]);

        // Add media for numbers with their associated quizzes
        $numbers = [
            [
                'file' => 'Screenshot 2025-03-31 140101.png',
                'description' => 'Le numéro un en rouge',
                'quizzes' => [
                    [
                        'question' => 'Quelle est la couleur du numéro?',
                        'options' => ['Rouge', 'Bleu', 'Vert', 'Jaune'],
                        'correct_option' => 0
                    ],
                    [
                        'question' => 'Quel est ce numéro?',
                        'options' => ['Deux', 'Un', 'Trois', 'Quatre'],
                        'correct_option' => 1
                    ]
                ]
            ],
            [
                'file' => 'Screenshot 2025-03-31 140104.png',
                'description' => 'Le numéro deux en bleu',
                'quizzes' => [
                    [
                        'question' => 'Quelle est la couleur du numéro?',
                        'options' => ['Rouge', 'Bleu', 'Vert', 'Jaune'],
                        'correct_option' => 1
                    ],
                    [
                        'question' => 'Quel est ce numéro?',
                        'options' => ['Un', 'Trois', 'Deux', 'Quatre'],
                        'correct_option' => 2
                    ]
                ]
            ],
            [
                'file' => 'Screenshot 2025-03-31 140108.png',
                'description' => 'Le numéro trois en vert',
                'quizzes' => [
                    [
                        'question' => 'Quelle est la couleur du numéro?',
                        'options' => ['Rouge', 'Bleu', 'Vert', 'Jaune'],
                        'correct_option' => 2
                    ],
                    [
                        'question' => 'Quel est ce numéro?',
                        'options' => ['Quatre', 'Deux', 'Un', 'Trois'],
                        'correct_option' => 3
                    ]
                ]
            ],
            [
                'file' => 'Screenshot 2025-03-31 140110.png',
                'description' => 'Le numéro quatre en jaune',
                'quizzes' => [
                    [
                        'question' => 'Quelle est la couleur du numéro?',
                        'options' => ['Rouge', 'Bleu', 'Vert', 'Jaune'],
                        'correct_option' => 3
                    ],
                    [
                        'question' => 'Quel est ce numéro?',
                        'options' => ['Trois', 'Quatre', 'Cinq', 'Deux'],
                        'correct_option' => 1
                    ]
                ]
            ],
            [
                'file' => 'Screenshot 2025-03-31 140114.png',
                'description' => 'Le numéro cinq en orange',
                'quizzes' => [
                    [
                        'question' => 'Quelle est la couleur du numéro?',
                        'options' => ['Rouge', 'Orange', 'Vert', 'Jaune'],
                        'correct_option' => 1
                    ],
                    [
                        'question' => 'Quel est ce numéro?',
                        'options' => ['Quatre', 'Trois', 'Cinq', 'Six'],
                        'correct_option' => 2
                    ]
                ]
            ]
        ];

        foreach ($numbers as $number) {
            // Create media
            $media = Media::create([
                'category_id' => $category->id,
                'type' => 'image',
                'file_path' => 'sample/' . $number['file'],
                'description' => $number['description']
            ]);

            // Create associated quizzes
            foreach ($number['quizzes'] as $quiz) {
                Quiz::create([
                    'category_id' => $category->id,
                    'question' => $quiz['question'],
                    'options' => json_encode($quiz['options']),
                    'correct_option' => $quiz['correct_option']
                ]);
            }
        }
    }
}
