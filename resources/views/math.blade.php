@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-50 dark:bg-gray-900 py-6 flex flex-col justify-center sm:py-12" x-data="{
    num1: 0,
    num2: 0,
    operation: '+',
    options: [],
    correctAnswer: 0,
    points: 0,
    message: '',
    messageClass: '',
    difficulty: 1,
    maxNumber: 10,

    init() {
        this.generateNewProblem();
    },

    generateNewProblem() {
        this.message = '';
        this.messageClass = '';
        
        // Generate random numbers based on difficulty
        this.num1 = Math.floor(Math.random() * (this.maxNumber + 1));
        this.num2 = Math.floor(Math.random() * (this.maxNumber + 1));
        
        // Randomly choose between addition and subtraction
        this.operation = Math.random() < 0.5 ? '+' : '-';
        
        // For subtraction, ensure num1 is larger than num2
        if (this.operation === '-' && this.num1 < this.num2) {
            [this.num1, this.num2] = [this.num2, this.num1];
        }
        
        // Calculate correct answer
        this.correctAnswer = this.operation === '+' 
            ? this.num1 + this.num2 
            : this.num1 - this.num2;
        
        // Generate options
        this.options = this.generateOptions();
    },

    generateOptions() {
        const options = [this.correctAnswer];
        while (options.length < 4) {
            const offset = Math.floor(Math.random() * 5) + 1;
            const option = Math.random() < 0.5 
                ? this.correctAnswer + offset 
                : this.correctAnswer - offset;
            if (!options.includes(option) && option >= 0) {
                options.push(option);
            }
        }
        return this.shuffleArray(options);
    },

    shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    },

    checkAnswer(selected) {
        if (selected === this.correctAnswer) {
            this.points += this.difficulty;
            this.message = 'Bravo! Bonne réponse! 🎉';
            this.messageClass = 'text-green-600 dark:text-green-400';
            
            // Update points in parent component
            this.$dispatch('points-updated', this.points);
            
            // Generate new problem after a short delay
            setTimeout(() => this.generateNewProblem(), 1000);
        } else {
            this.message = 'Essaie encore! 🤔';
            this.messageClass = 'text-red-600 dark:text-red-400';
        }
    },

    increaseDifficulty() {
        this.difficulty++;
        this.maxNumber = this.difficulty * 10;
        this.generateNewProblem();
    },

    decreaseDifficulty() {
        if (this.difficulty > 1) {
            this.difficulty--;
            this.maxNumber = this.difficulty * 10;
            this.generateNewProblem();
        }
    }
}">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white dark:bg-gray-800 shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 dark:text-gray-200 sm:text-lg sm:leading-7">
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">Jeu de Mathématiques</h1>
                            <p class="text-gray-600 dark:text-gray-300">Niveau: <span x-text="difficulty"></span></p>
                        </div>

                        <!-- Difficulty controls -->
                        <div class="flex justify-center space-x-4 mb-8">
                            <button @click="decreaseDifficulty()" 
                                class="px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 dark:bg-yellow-900 dark:text-yellow-300 transition-colors"
                                :disabled="difficulty <= 1">
                                ⬇️ Plus facile
                            </button>
                            <button @click="increaseDifficulty()" 
                                class="px-4 py-2 bg-green-100 text-green-600 rounded-full hover:bg-green-200 dark:bg-green-900 dark:text-green-300 transition-colors">
                                ⬆️ Plus difficile
                            </button>
                        </div>

                        <!-- Math problem -->
                        <div class="text-center mb-8">
                            <p class="text-4xl font-bold mb-4">
                                <span x-text="num1"></span>
                                <span x-text="operation"></span>
                                <span x-text="num2"></span>
                                <span class="text-blue-600 dark:text-blue-400">=</span>
                                <span>?</span>
                            </p>
                        </div>

                        <!-- Answer options -->
                        <div class="grid grid-cols-2 gap-4">
                            <template x-for="option in options" :key="option">
                                <button 
                                    @click="checkAnswer(option)"
                                    class="quiz-option w-full p-4 text-center text-lg font-semibold bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-colors"
                                    x-text="option">
                                </button>
                            </template>
                        </div>

                        <!-- Feedback message -->
                        <div class="text-center mt-6">
                            <p class="text-xl font-bold" :class="messageClass" x-text="message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 