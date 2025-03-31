@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400">Apprends les Nombres</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Clique sur "Commencer le quiz" pour tester tes connaissances !</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($categories as $category)
            @foreach ($category->media as $mediaItem)
            <div class="number-card bg-white dark:bg-gray-800 shadow-lg overflow-hidden p-6" 
                 x-data="{ 
                     showQuiz: false,
                     currentQuestion: 0,
                     score: 0,
                     showResults: false,
                     answers: [],
                     quizData: {{ Illuminate\Support\Js::from($mediaItem->quizzes) }},
                     
                     init() {
                         this.quizData = this.quizData.map(quiz => ({
                             ...quiz,
                             parsedOptions: JSON.parse(quiz.options)
                         }));
                     },
                     
                     checkAnswer(selectedOption) {
                         const currentQuiz = this.quizData[this.currentQuestion];
                         const isCorrect = selectedOption === currentQuiz.correct_option;
                         
                         this.answers.push({
                             question: currentQuiz.question,
                             selectedOption: selectedOption,
                             correctOption: currentQuiz.correct_option,
                             isCorrect: isCorrect,
                             options: currentQuiz.parsedOptions
                         });
                         
                         if (isCorrect) {
                             this.score++;
                             $dispatch('points-updated', { points: 1 });
                         }
                         
                         if (this.currentQuestion < this.quizData.length - 1) {
                             this.currentQuestion++;
                         } else {
                             this.showResults = true;
                         }
                     },
                     
                     resetQuiz() {
                         this.showQuiz = false;
                         this.currentQuestion = 0;
                         this.score = 0;
                         this.showResults = false;
                         this.answers = [];
                     }
                 }"
                 @points-updated.window="points += $event.detail.points">
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $mediaItem->file_path) }}" 
                         alt="Numéro" 
                         class="w-full h-48 object-contain rounded-lg">
                    <p class="mt-2 text-gray-600 dark:text-white text-center">{{ $mediaItem->description }}</p>
                </div>

                <div class="space-y-4">
                    <button 
                        @click="resetQuiz(); showQuiz = !showQuiz"
                        class="quiz-button bg-blue-500 text-white px-4 py-2 rounded-lg w-full text-center font-semibold hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700"
                        x-text="showQuiz ? 'Fermer le quiz' : 'Commencer le quiz!'">
                    </button>

                    <div x-show="showQuiz" x-cloak class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-inner">
                        <template x-if="!showResults && quizData && quizData.length > 0">
                            <div>
                                <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white" x-text="quizData[currentQuestion].question"></h3>
                                <div class="space-y-2">
                                    <template x-for="(option, index) in quizData[currentQuestion].parsedOptions" :key="index">
                                        <button 
                                            @click="checkAnswer(index)"
                                            class="quiz-option w-full p-2 text-left rounded transition border"
                                            x-text="option">
                                        </button>
                                    </template>
                                </div>
                                <p class="mt-4 text-blue-600 dark:text-blue-400 text-center">Question <span x-text="currentQuestion + 1"></span>/<span x-text="quizData.length"></span></p>
                            </div>
                        </template>

                        <template x-if="showResults">
                            <div class="space-y-6">
                                <div class="text-center">
                                    <h3 class="text-xl font-bold mb-2 dark:text-white">Résultats du Quiz</h3>
                                    <p class="text-lg dark:text-gray-300">
                                        Score: <span class="text-blue-600 dark:text-blue-400 font-bold" x-text="score"></span>/<span x-text="quizData.length"></span>
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <template x-for="(answer, index) in answers" :key="index">
                                        <div :class="answer.isCorrect ? 'bg-green-50 dark:bg-green-900 border-green-200 dark:border-green-700' : 'bg-red-50 dark:bg-red-900 border-red-200 dark:border-red-700'" class="p-4 rounded-lg border">
                                            <p class="font-semibold mb-2 dark:text-white" x-text="answer.question"></p>
                                            <p class="text-sm dark:text-gray-300">
                                                Ta réponse: <span :class="answer.isCorrect ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'" x-text="answer.options[answer.selectedOption]"></span>
                                            </p>
                                            <template x-if="!answer.isCorrect">
                                                <p class="text-sm mt-1 dark:text-gray-300">
                                                    Bonne réponse: <span class="text-green-600 dark:text-green-400" x-text="answer.options[answer.correctOption]"></span>
                                                </p>
                                            </template>
                                        </div>
                                    </template>
                                </div>

                                <button 
                                    @click="resetQuiz()"
                                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                                    Recommencer le quiz
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
@endsection 