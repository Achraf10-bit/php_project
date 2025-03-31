<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site d'apprentissage des enfants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Dark mode styles */
        .dark body { background-color: #1a1a1a; }
        .dark .bg-white { background-color: #2d2d2d; }
        .dark .text-gray-600 { color: #ffffff !important; }
        .dark .text-gray-900 { color: #ffffff !important; }
        .dark .text-blue-600 { color: #60a5fa; }
        .dark .bg-blue-50 { background-color: #1a1a2e; }
        .dark .bg-blue-100 { background-color: #1e3a8a; }
        .dark .bg-green-100 { background-color: #064e3b; }
        .dark .border-gray-200 { border-color: #4a4a4a; }
        .dark .hover\:bg-blue-100:hover { background-color: #1e40af; }
        .dark .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5); }
        .dark .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.3); }
        .dark input { background-color: #3d3d3d; color: white; border-color: #4a4a4a; }
        .dark input::placeholder { color: #9ca3af; }
        .dark .bg-green-50 { background-color: #064e3b; }
        .dark .bg-red-50 { background-color: #7f1d1d; }
        .dark .border-green-200 { border-color: #059669; }
        .dark .border-red-200 { border-color: #ef4444; }
        .dark .text-green-600 { color: #34d399; }
        .dark .text-red-600 { color: #f87171; }
        .dark p, .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 { color: #ffffff; }
        .dark .quiz-option { background-color: #374151; color: #ffffff; }
        .dark .quiz-option:hover { background-color: #4B5563; }
        .dark .bg-purple-50 { background-color: #4c1d95; }
        .dark .text-purple-600 { color: #e9d5ff; }
        
        /* Dark mode styles for navigation links */
        .dark .bg-red-100 { background-color: #7f1d1d; }
        .dark .bg-purple-100 { background-color: #4c1d95; }
        .dark .hover\:bg-red-200:hover { background-color: #991b1b; }
        .dark .hover\:bg-purple-200:hover { background-color: #5b21b6; }
        
        /* Smooth transitions */
        body, .bg-white, .text-gray-600, .text-blue-600, .bg-blue-50, 
        .bg-blue-100, .bg-green-100, .border-gray-200, input, .shadow-lg,
        .shadow-inner {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen" 
      x-data="{ 
          userName: localStorage.getItem('userName') || '', 
          showNamePrompt: !localStorage.getItem('userName'), 
          points: 0,
          toggleDarkMode() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
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
                <!-- Logo on the left -->
                <div class="flex items-center w-1/4 -ml-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 pl-2">
                        <svg class="w-8 h-8 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3L20 7.5V16.5L12 21L4 16.5V7.5L12 3Z"/>
                            <path d="M12 12L20 7.5"/>
                            <path d="M12 12V21"/>
                            <path d="M12 12L4 7.5"/>
                            <circle cx="12" cy="7.5" r="1"/>
                        </svg>
                        <h1 class="text-2xl font-bold text-blue-600">Apprendre en s'amusant</h1>
                    </a>
                </div>
                
                <!-- Centered game links -->
                <div class="flex items-center justify-center flex-1 space-x-4">
                    <a href="{{ route('numbers') }}" class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm hover:bg-blue-200 transition-colors">
                        🔢 Les Nombres
                    </a>
                    <a href="{{ route('memory') }}" class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm hover:bg-green-200 transition-colors">
                        🎮 Jeu de mémoire
                    </a>
                    <a href="{{ route('math') }}" class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-sm hover:bg-red-200 transition-colors">
                        ➕ Mathématiques
                    </a>
                    <a href="{{ route('colors') }}" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm hover:bg-purple-200 transition-colors">
                        🎨 Les Couleurs
                    </a>
                </div>

                <!-- User info, dark mode, and disconnect on the right -->
                <div class="flex items-center w-1/4 justify-end space-x-6 pr-4">
                    <button 
                        @click="toggleDarkMode()"
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :aria-label="darkMode ? 'Activer le mode clair' : 'Activer le mode sombre'">
                        <template x-if="!darkMode">
                            <span class="text-xl">🌙</span>
                        </template>
                        <template x-if="darkMode">
                            <span class="text-xl">☀️</span>
                        </template>
                    </button>
                    <div class="text-blue-600">
                        <span x-text="userName"></span>
                        <span class="ml-3">Points: <span x-text="points"></span></span>
                    </div>
                    <button 
                        @click="localStorage.removeItem('userName'); userName = ''; showNamePrompt = true;"
                        class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm hover:bg-red-200 transition-colors dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                        🚪 Déconnexion
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html> 