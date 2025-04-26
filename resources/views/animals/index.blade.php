<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte d'Animaux</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f9ff;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4caf50;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        h1 {
            color: white;
            margin: 0;
        }
        .animals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .animal-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        .animal-card:hover {
            transform: scale(1.05);
        }
        .animal-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .animal-info {
            padding: 15px;
            text-align: center;
        }
        .animal-name {
            font-size: 1.5em;
            color: #4caf50;
            margin: 0 0 10px 0;
        }
        .animal-description {
            color: #666;
            font-size: 1em;
            margin: 0;
        }
        .animal-sound {
            display: none;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
        }
        .back-link:hover {
            color: #4caf50;
        }
        .add-animal-form {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: inherit;
        }
        button:hover {
            background-color: #45a049;
        }
        .edit-btn {
            background-color: #4caf50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            margin-top: 10px;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #ff4081;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .delete-btn:hover {
            background-color: #f50057;
        }
        .sound-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Retour à l'accueil</a>
        
        <div class="header">
            <h1>🦊 Carte d'Animaux</h1>
        </div>

        <div class="add-animal-form">
            <h2>Ajouter un nouvel animal</h2>
            <form action="{{ route('animals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom de l'animal</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="image_url">URL de l'image</label>
                    <input type="text" id="image_url" name="image_url" required>
                </div>
                <div class="form-group">
                    <label for="sound_url">URL du son</label>
                    <input type="text" id="sound_url" name="sound_url" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (optionnel)</label>
                    <textarea id="description" name="description"></textarea>
                </div>
                <button type="submit">Ajouter l'animal</button>
            </form>
        </div>

        <div class="animals-grid">
            @foreach($animals as $animal)
                <div class="animal-card" data-sound="{{ $animal->sound_url }}">
                    <img src="{{ $animal->image_url }}" alt="{{ $animal->name }}" class="animal-image">
                    <div class="sound-icon">🔊</div>
                    <div class="animal-info">
                        <h3 class="animal-name">{{ $animal->name }}</h3>
                        @if($animal->description)
                            <p class="animal-description">{{ $animal->description }}</p>
                        @endif
                        <audio class="animal-sound" src="{{ $animal->sound_url }}" preload="auto"></audio>
                        <div>
                            <a href="{{ route('animals.edit', $animal->id) }}" class="edit-btn">Modifier</a>
                            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animalCards = document.querySelectorAll('.animal-card');
            
            animalCards.forEach(card => {
                const sound = card.querySelector('.animal-sound');
                
                card.addEventListener('mouseenter', function() {
                    sound.play();
                });
                
                card.addEventListener('mouseleave', function() {
                    sound.pause();
                    sound.currentTime = 0;
                });
            });
        });
    </script>
</body>
</html> 