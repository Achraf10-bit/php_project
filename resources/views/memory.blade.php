@extends('layouts.app')

@section('content')
<style>
    .memory-card {
        perspective: 1000px;
        min-height: 200px;
        margin: 10px;
    }
    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        min-height: 200px;
    }
    .card-flipped .card-inner {
        transform: rotateY(180deg);
    }
    .card-front, .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        min-height: 200px;
    }
    .card-back {
        background-color: white;
        transform: rotateY(0deg);
        border: 2px solid #e5e7eb;
        font-size: 4rem;
    }
    .card-front {
        background-color: #93c5fd;
        transform: rotateY(180deg);
        border: 2px solid #93c5fd;
        font-size: 6rem;
        padding: 20px;
    }
    .dark .card-back {
        background-color: #374151;
        border-color: #4b5563;
    }
    .dark .card-front {
        background-color: #1e40af;
        border-color: #2563eb;
    }
</style>

<div class="container mx-auto px-4 py-8" x-data="{
    gameStarted: false,
    difficulty: 'easy',
    theme: 'numbers',
    cards: [],
    flippedCards: [],
    matchedPairs: 0,
    moves: 0,
    totalPairs: 0,
    showVictory: false,

    initGame() {
        this.cards = [];
        this.flippedCards = [];
        this.matchedPairs = 0;
        this.moves = 0;
        
        let pairs = this.difficulty === 'easy' ? 6 : this.difficulty === 'medium' ? 8 : 10;
        let symbols = this.getSymbols();
        let selectedSymbols = symbols.slice(0, pairs);
        
        let cardPairs = [...selectedSymbols, ...selectedSymbols];
        this.cards = cardPairs
            .map((symbol, index) => ({
                id: index,
                content: symbol,
                matched: false,
                flipped: false
            }))
            .sort(() => Math.random() - 0.5);
            
        this.gameStarted = true;
        this.totalPairs = pairs;
        this.matchedPairs = 0;
        this.showVictory = false;
    },

    getSymbols() {
        if (this.theme === 'numbers') {
            return ['0️⃣', '1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣', '6️⃣', '7️⃣', '8️⃣', '9️⃣'];
        } else if (this.theme === 'animals') {
            return ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🐻', '🐼', '🐨', '🐯'];
        } else {
            return ['🍎', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐', '🍒'];
        }
    },

    flipCard(card) {
        if (this.flippedCards.length === 2 || card.matched || card.flipped) return;
        
        card.flipped = true;
        this.flippedCards.push(card);
        
        if (this.flippedCards.length === 2) {
            this.moves++;
            if (this.flippedCards[0].content === this.flippedCards[1].content) {
                this.flippedCards[0].matched = true;
                this.flippedCards[1].matched = true;
                this.matchedPairs++;
                this.points += 10;
                this.flippedCards = [];
                
                if (this.matchedPairs === this.totalPairs) {
                    setTimeout(() => {
                        this.showVictory = true;
                    }, 500);
                }
            } else {
                setTimeout(() => {
                    this.flippedCards[0].flipped = false;
                    this.flippedCards[1].flipped = false;
                    this.flippedCards = [];
                }, 1000);
            }
        }
    },

    resetGame() {
        this.gameStarted = false;
        this.showVictory = false;
        this.cards = [];
        this.flippedCards = [];
        this.matchedPairs = 0;
        this.moves = 0;
        this.initGame();
    }
}">
    <div class="max-w-4xl mx-auto" x-show="!gameStarted">
        <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">Jeu de Mémoire</h1>
        <p class="text-gray-600 dark:text-gray-300">Choisis la difficulté et le thème pour commencer !</p>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 space-y-4 mt-6">
            <div>
                <label class="block text-gray-600 dark:text-gray-300 mb-2">Difficulté:</label>
                <select x-model="difficulty" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="easy">Facile (6 paires)</option>
                    <option value="medium">Moyen (8 paires)</option>
                    <option value="hard">Difficile (10 paires)</option>
                </select>
            </div>
            
            <div>
                <label class="block text-gray-600 dark:text-gray-300 mb-2">Thème:</label>
                <select x-model="theme" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="numbers">Nombres</option>
                    <option value="animals">Animaux</option>
                    <option value="fruits">Fruits</option>
                </select>
            </div>
            
            <button 
                @click="initGame()"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                Commencer le jeu
            </button>
        </div>
    </div>

    <div x-show="gameStarted" class="space-y-4">
        <div class="flex justify-between items-center mb-4">
            <div class="text-gray-600 dark:text-gray-300">
                <span>Coups: <span x-text="moves"></span></span>
                <span class="ml-4">Paires trouvées: <span x-text="matchedPairs"></span>/<span x-text="totalPairs"></span></span>
            </div>
            <button 
                @click="resetGame()"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                Nouvelle partie
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 p-6">
            <template x-for="(card, index) in cards" :key="index">
                <div 
                    @click="flipCard(card)"
                    class="memory-card cursor-pointer"
                    :class="{ 'card-flipped': card.flipped, 'pointer-events-none': card.matched || (card.flipped && flippedCards.length === 2) }">
                    <div class="card-inner shadow-lg">
                        <!-- Card Back -->
                        <div class="card-back">
                            ❓
                        </div>
                        <!-- Card Front -->
                        <div class="card-front">
                            <span x-text="card.content"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div 
        x-show="showVictory" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full text-center">
            <h2 class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-4">Félicitations!</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Tu as gagné en <span x-text="moves"></span> coups!
            </p>
            <button 
                @click="resetGame()"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                Rejouer
            </button>
        </div>
    </div>
</div>
@endsection 