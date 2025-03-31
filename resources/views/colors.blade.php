@extends('layouts.app')

@section('content')
<style>
    .dark .color-option {
        color: white !important;
    }
</style>
<div class="min-h-screen bg-blue-50 dark:bg-gray-900 py-6 flex flex-col justify-center sm:py-12" x-data="{
    colors: [
        { fr: 'Rouge', en: 'Red', hex: '#EF4444', emoji: '🔴' },
        { fr: 'Bleu', en: 'Blue', hex: '#3B82F6', emoji: '🔵' },
        { fr: 'Vert', en: 'Green', hex: '#10B981', emoji: '💚' },
        { fr: 'Jaune', en: 'Yellow', hex: '#F59E0B', emoji: '💛' },
        { fr: 'Orange', en: 'Orange', hex: '#F97316', emoji: '🟧' },
        { fr: 'Violet', en: 'Purple', hex: '#8B5CF6', emoji: '💜' },
        { fr: 'Rose', en: 'Pink', hex: '#EC4899', emoji: '💗' },
        { fr: 'Marron', en: 'Brown', hex: '#92400E', emoji: '🟫' }
    ],
    currentColor: null,
    options: [],
    message: '',
    messageClass: '',
    points: 0,
    streak: 0,
    
    init() {
        this.generateNewRound();
    },

    generateNewRound() {
        this.message = '';
        this.messageClass = '';
        
        // Select random color as correct answer
        this.currentColor = this.colors[Math.floor(Math.random() * this.colors.length)];
        
        // Generate options including the correct answer
        this.options = [this.currentColor];
        
        // Add 3 more random unique colors
        while (this.options.length < 4) {
            const randomColor = this.colors[Math.floor(Math.random() * this.colors.length)];
            if (!this.options.some(c => c.fr === randomColor.fr)) {
                this.options.push(randomColor);
            }
        }
        
        // Shuffle options
        this.options = this.shuffleArray(this.options);
    },

    shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    },

    checkAnswer(selected) {
        if (selected.fr === this.currentColor.fr) {
            this.streak++;
            this.points += this.streak;
            this.message = `Bravo! C'est bien ${selected.fr}! 🎉`;
            this.messageClass = 'text-green-600 dark:text-green-400';
            
            // Update points in parent component
            this.$dispatch('points-updated', this.points);
            
            // Generate new round after a short delay
            setTimeout(() => this.generateNewRound(), 1000);
        } else {
            this.streak = 0;
            this.message = `Essaie encore! Ce n'est pas ${selected.fr} 🤔`;
            this.messageClass = 'text-red-600 dark:text-red-400';
        }
    }
}">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white dark:bg-gray-800 shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 dark:text-gray-200 sm:text-lg sm:leading-7">
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">Les Couleurs</h1>
                            <p class="text-gray-600 dark:text-gray-300">Série de bonnes réponses: <span x-text="streak"></span></p>
                        </div>

                        <!-- Color to match -->
                        <div class="text-center mb-8">
                            <div class="w-32 h-32 mx-auto rounded-lg shadow-lg mb-4"
                                x-bind:style="'background-color: ' + currentColor.hex">
                            </div>
                            <p class="text-2xl font-bold mb-2">
                                <span x-text="currentColor.emoji"></span>
                                Quelle est cette couleur?
                            </p>
                        </div>

                        <!-- Color options -->
                        <div class="grid grid-cols-2 gap-4">
                            <template x-for="option in options" :key="option.fr">
                                <button 
                                    @click="checkAnswer(option)"
                                    class="color-option w-full p-4 text-center text-lg font-semibold bg-white dark:bg-gray-700 rounded-xl border-2 dark:border-gray-600 transition-all duration-200 hover:scale-105"
                                    x-bind:style="darkMode ? '' : 'border-color: ' + option.hex">
                                    <span x-text="option.fr"></span>
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