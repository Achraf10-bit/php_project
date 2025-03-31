<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site d'apprentissage des enfants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <style>
        .category-card {
            transition: transform 0.3s ease;
            border-radius: 20px;
        }
        .category-card:hover {
            transform: scale(1.02);
        }
        .media-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            background-color: #f8fafc;
        }
        .media-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .quiz-button {
            transition: all 0.3s ease;
        }
        .quiz-button:hover {
            transform: scale(1.05);
        }
        .memory-card {
            perspective: 1000px;
            transform-style: preserve-3d;
            transition: transform 0.5s;
        }
        .memory-card.flipped {
            transform: rotateY(180deg);
        }
        .draggable {
            cursor: move;
            user-select: none;
        }
        .dropzone {
            min-height: 100px;
            border: 2px dashed #cbd5e0;
        }
        .dropzone.dragover {
            background-color: #e2e8f0;
            border-color: #4299e1;
        }
        .number-card {
            transition: transform 0.3s ease;
            border-radius: 20px;
        }
        .number-card:hover {
            transform: scale(1.02);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-blue-50 min-h-screen" x-data="mainApp">
    <div x-data="{ 
        userName: localStorage.getItem('userName') || '',
        showNamePrompt: !localStorage.getItem('userName'),
        points: 0,
        showLeaderboard: false,
        leaderboard: [],
        
        init() {
            this.$watch('points', value => {
                if (this.userName) {
                    this.leaderboard = [
                        ...this.leaderboard.filter(p => p.name !== this.userName),
                        { name: this.userName, score: value }
                    ].sort((a, b) => b.score - a.score);
                }
            });
        }
    }">
        <!-- User Name Prompt -->
        <div x-show="showNamePrompt" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">Bienvenue! Comment t'appelles-tu?</h2>
                <form @submit.prevent="if(userName.trim()) { localStorage.setItem('userName', userName.trim()); showNamePrompt = false; }">
                    <input 
                        type="text" 
                        x-model="userName" 
                        class="w-full border rounded px-3 py-2 mb-4"
                        placeholder="Ton prénom"
                        required>
                    <button 
                        type="submit"
                        class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Commencer à jouer!
                    </button>
                </form>
            </div>
        </div>

        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center space-x-2">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiMzQjgyRjYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNMTIgMjJzOC02IDgtMTJBOCA4IDAgMCAwIDQgMTBjMCA2IDggMTIgOCAxMnoiPjwvcGF0aD48L3N2Zz4=" alt="Logo" class="w-6 h-6">
                        <h1 class="text-2xl font-bold text-blue-600">Apprendre en s'amusant</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-blue-600">
                            <span x-text="userName"></span>
                            <span class="ml-2">Points: <span x-text="points"></span></span>
                        </div>
                        <button 
                            @click="showLeaderboard = !showLeaderboard"
                            class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
                            🏆 Classement
                        </button>
                        <a href="/memory" class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                            🎮 Jeu de mémoire
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Leaderboard Modal -->
        <div x-show="showLeaderboard" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">🏆 Classement</h2>
                <div class="space-y-2">
                    <template x-for="(player, index) in leaderboard" :key="index">
                        <div class="flex justify-between items-center p-2 bg-blue-50 rounded">
                            <span x-text="player.name"></span>
                            <span x-text="player.score + ' points'"></span>
                        </div>
                    </template>
                </div>
                <button 
                    @click="showLeaderboard = false"
                    class="mt-4 w-full bg-blue-500 text-white px-4 py-2 rounded">
                    Fermer
                </button>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($categories as $category)
                    @if($category->name === 'Nombres et Chiffres')
                        @foreach ($category->media as $mediaItem)
                        <div class="number-card bg-white shadow-lg overflow-hidden p-6" 
                             x-data="{ 
                                 showQuiz: false,
                                 currentQuestion: 0,
                                 score: 0,
                                 showResults: false,
                                 answers: [],
                                 quizData: {{ Illuminate\Support\Js::from($mediaItem->quizzes) }},
                                 
                                 init() {
                                     // Parse options once at initialization
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
                                <p class="mt-2 text-gray-600 text-center">{{ $mediaItem->description }}</p>
                            </div>

                            <div class="space-y-4">
                                <button 
                                    @click="resetQuiz(); showQuiz = !showQuiz"
                                    class="quiz-button bg-blue-500 text-white px-4 py-2 rounded-lg w-full text-center font-semibold"
                                    x-text="showQuiz ? 'Fermer le quiz' : 'Commencer le quiz!'">
                                </button>

                                <div x-show="showQuiz" x-cloak class="bg-white p-4 rounded-lg shadow-inner">
                                    <template x-if="!showResults && quizData && quizData.length > 0">
                                        <div>
                                            <h3 class="font-bold text-lg mb-4" x-text="quizData[currentQuestion].question"></h3>
                                            <div class="space-y-2">
                                                <template x-for="(option, index) in quizData[currentQuestion].parsedOptions" :key="index">
                                                    <button 
                                                        @click="checkAnswer(index)"
                                                        class="w-full p-2 text-left rounded hover:bg-blue-100 transition border border-gray-200"
                                                        x-text="option">
                                                    </button>
                                                </template>
                                            </div>
                                            <p class="mt-4 text-blue-600 text-center">Question <span x-text="currentQuestion + 1"></span>/<span x-text="quizData.length"></span></p>
                                        </div>
                                    </template>

                                    <template x-if="showResults">
                                        <div class="space-y-6">
                                            <div class="text-center">
                                                <h3 class="text-xl font-bold mb-2">Résultats du Quiz</h3>
                                                <p class="text-lg">
                                                    Score: <span class="text-blue-600 font-bold" x-text="score"></span>/<span x-text="quizData.length"></span>
                                                </p>
                                            </div>

                                            <div class="space-y-4">
                                                <template x-for="(answer, index) in answers" :key="index">
                                                    <div :class="answer.isCorrect ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'" class="p-4 rounded-lg border">
                                                        <p class="font-semibold mb-2" x-text="answer.question"></p>
                                                        <p class="text-sm">
                                                            Ta réponse: <span :class="answer.isCorrect ? 'text-green-600' : 'text-red-600'" x-text="answer.options[answer.selectedOption]"></span>
                                                        </p>
                                                        <template x-if="!answer.isCorrect">
                                                            <p class="text-sm mt-1">
                                                                Bonne réponse: <span class="text-green-600" x-text="answer.options[answer.correctOption]"></span>
                                                            </p>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>

                                            <button 
                                                @click="resetQuiz()"
                                                class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                                Recommencer le quiz
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="category-card bg-white shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-blue-600 mb-2">{{ $category->name }}</h2>
                            <p class="text-gray-600 mb-6 text-sm">{{ $category->description }}</p>
                            
                            <div class="space-y-4">
                                @foreach ($category->media as $mediaItem)
                                <div class="media-item p-4" x-data="quizCard(@json($mediaItem->quizzes))">
                                    @if ($mediaItem->type === 'image')
                                        <img src="{{ asset('storage/' . $mediaItem->file_path) }}" 
                                             alt="Image éducative" 
                                             class="w-full h-48 object-cover rounded-lg">
                                    @elseif ($mediaItem->type === 'audio')
                                        <div class="bg-white rounded-lg p-4">
                                            <p class="text-sm text-gray-600 mb-2">🎵 Audio éducatif</p>
                                            <audio controls class="w-full">
                                                <source src="{{ asset('storage/' . $mediaItem->file_path) }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    @elseif ($mediaItem->type === 'video')
                                        <div class="relative rounded-lg overflow-hidden">
                                            <video controls class="w-full">
                                                <source src="{{ asset('storage/' . $mediaItem->file_path) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    @endif
                                    @if($mediaItem->description)
                                        <p class="mt-2 text-gray-600 text-sm">{{ $mediaItem->description }}</p>
                                    @endif

                                    <div class="mt-4">
                                        <button 
                                            @click="showQuiz = !showQuiz"
                                            class="quiz-button bg-blue-500 text-white px-4 py-2 rounded-lg w-full text-center font-semibold"
                                            x-text="showQuiz ? 'Fermer le quiz' : 'Quiz!'">
                                        </button>

                                        <div x-show="showQuiz" class="mt-4 bg-white p-4 rounded-lg shadow">
                                            <template x-if="questions && questions.length > 0">
                                                <div>
                                                    <h3 class="font-bold text-lg mb-4" x-text="questions[currentQuestion].question"></h3>
                                                    <div class="space-y-2">
                                                        <template x-for="(option, index) in JSON.parse(questions[currentQuestion].options)" :key="index">
                                                            <button 
                                                                @click="checkAnswer(index)"
                                                                class="w-full p-2 text-left rounded hover:bg-blue-100 transition"
                                                                x-text="option">
                                                            </button>
                                                        </template>
                                                    </div>
                                                    <p class="mt-4 text-blue-600">Score: <span x-text="score"></span></p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

        <footer class="bg-white mt-12 py-4">
            <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
                <p>Site d'apprentissage pour les enfants ⭐</p>
            </div>
        </footer>
    </div>

    <script>
        // Initialize Drag & Drop
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.draggable').forEach(draggable => {
                draggable.addEventListener('dragstart', e => {
                    e.dataTransfer.setData('text/plain', draggable.dataset.id);
                });
            });

            document.querySelectorAll('.dropzone').forEach(dropzone => {
                dropzone.addEventListener('dragenter', e => dropzone.classList.add('dragover'));
                dropzone.addEventListener('dragleave', e => dropzone.classList.remove('dragover'));
                dropzone.addEventListener('drop', e => dropzone.classList.remove('dragover'));
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('mainApp', () => ({
                userName: localStorage.getItem('userName') || '',
                showNamePrompt: !localStorage.getItem('userName'),
                points: 0,
                badges: [],
                leaderboard: [],
                showLeaderboard: false,

                init() {
                    this.$watch('points', (value) => {
                        if (this.userName) {
                            this.leaderboard = [...this.leaderboard.filter(p => p.name !== this.userName), 
                                { name: this.userName, score: value }]
                                .sort((a, b) => b.score - a.score);
                        }
                    });
                }
            }));

            Alpine.data('quizCard', (mediaQuizzes) => ({
                showQuiz: false,
                currentQuestion: 0,
                score: 0,
                questions: mediaQuizzes,

                checkAnswer(selectedOption) {
                    if (selectedOption === this.questions[this.currentQuestion].correct_option) {
                        this.score++;
                        this.$dispatch('score-updated', { points: 1 });
                    }
                    if (this.currentQuestion < this.questions.length - 1) {
                        this.currentQuestion++;
                    } else {
                        setTimeout(() => {
                            this.showQuiz = false;
                            this.currentQuestion = 0;
                        }, 1500);
                    }
                }
            }));
        });

        window.addEventListener('score-updated', (event) => {
            const app = document.querySelector('[x-data="mainApp"]').__x.$data;
            app.points += event.detail.points;
        });
    </script>
</body>
</html>