<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Site d'apprentissage des enfants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold">Administration</h1>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Categories Section -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <h2 class="text-lg font-semibold mb-4">Gestion des catégories</h2>
            
            <!-- Add Category Form -->
            <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex gap-4">
                    <input type="text" name="name" placeholder="Nom de la catégorie" class="flex-1 border rounded px-3 py-2">
                    <input type="text" name="description" placeholder="Description" class="flex-1 border rounded px-3 py-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
                </div>
            </form>

            <!-- Categories List -->
            <div class="mt-4">
                @foreach($categories as $category)
                <div class="border-b py-3 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold">{{ $category->name }}</h3>
                        <p class="text-gray-600">{{ $category->description }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editCategory({{ $category->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Modifier</button>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Media Upload Section -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Gestion des médias</h2>
            
            <!-- Upload Form -->
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type de média</label>
                        <select name="type" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="image">Image</option>
                            <option value="audio">Audio</option>
                            <option value="video">Vidéo</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select name="category_id" class="mt-1 block w-full border rounded px-3 py-2">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fichier</label>
                    <input type="file" name="media_file" class="mt-1 block w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" class="mt-1 block w-full border rounded px-3 py-2" rows="3"></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Télécharger</button>
            </form>

            <!-- Media List -->
            <div class="mt-6 space-y-4">
                @foreach($media as $item)
                <div class="border rounded p-4 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $item->type }} - {{ $item->category->name }}</p>
                        <p class="text-gray-600">{{ $item->description }}</p>
                    </div>
                    <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function editCategory(id) {
            // Implement edit functionality
        }
    </script>
</body>
</html> 