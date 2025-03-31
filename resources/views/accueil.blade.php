@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-50 dark:bg-gray-900 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white dark:bg-gray-800 shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 dark:text-gray-300 sm:text-lg sm:leading-7">
                        <h1 class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400 mb-8">Bienvenue sur notre site d'apprentissage</h1>
                        <p class="text-center mb-8">Choisis une activité pour commencer à apprendre en t'amusant !</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Numbers Card -->
                            <a href="{{ route('numbers') }}" class="block p-6 bg-blue-50 dark:bg-blue-900 rounded-xl hover:shadow-xl transition-shadow">
                                <div class="text-center">
                                    <div class="text-4xl mb-4">🔢</div>
                                    <h2 class="text-xl font-bold text-blue-600 dark:text-blue-300 mb-2">Les Nombres</h2>
                                    <p class="text-gray-600 dark:text-gray-300">Apprends les nombres et leurs couleurs</p>
                                </div>
                            </a>

                            <!-- Memory Game Card -->
                            <a href="{{ route('memory') }}" class="block p-6 bg-green-50 dark:bg-green-900 rounded-xl hover:shadow-xl transition-shadow">
                                <div class="text-center">
                                    <div class="text-4xl mb-4">🎮</div>
                                    <h2 class="text-xl font-bold text-green-600 dark:text-green-300 mb-2">Jeu de Mémoire</h2>
                                    <p class="text-gray-600 dark:text-gray-300">Teste ta mémoire avec un jeu amusant</p>
                                </div>
                            </a>

                            <!-- Math Game Card -->
                            <a href="{{ route('math') }}" class="block p-6 bg-red-50 dark:bg-red-900 rounded-xl hover:shadow-xl transition-shadow">
                                <div class="text-center">
                                    <div class="text-4xl mb-4">➕</div>
                                    <h2 class="text-xl font-bold text-red-600 dark:text-red-300 mb-2">Mathématiques</h2>
                                    <p class="text-gray-600 dark:text-gray-300">Apprends l'addition et la soustraction en t'amusant</p>
                                </div>
                            </a>

                            <!-- Color Game Card -->
                            <a href="{{ route('colors') }}" class="block p-6 bg-purple-50 dark:bg-purple-800 rounded-xl hover:shadow-xl transition-shadow">
                                <div class="text-center">
                                    <div class="text-4xl mb-4">🎨</div>
                                    <h2 class="text-xl font-bold text-purple-600 dark:text-purple-200 mb-2">Les Couleurs</h2>
                                    <p class="text-gray-600 dark:text-gray-300">Découvre et apprends les couleurs en français</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 