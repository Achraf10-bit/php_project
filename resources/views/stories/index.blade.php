<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histoires pour Enfants</title>
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
            background-color: #ff9ecd;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        h1 {
            color: #ff4081;
            margin: 0;
        }
        .story-form {
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
            height: 150px;
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
        .stories-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .story-card {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .story-card h3 {
            color: #ff4081;
            margin-top: 0;
        }
        .story-card p {
            color: #666;
        }
        .delete-btn {
            background-color: #ff4081;
        }
        .delete-btn:hover {
            background-color: #f50057;
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
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
        }
        .back-link:hover {
            color: #ff4081;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Retour à l'accueil</a>
        
        <div class="header">
            <h1>📚 Histoires pour Enfants</h1>
        </div>

        <div class="story-form">
            <h2>Ajouter une nouvelle histoire</h2>
            <form action="{{ route('stories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Titre de l'histoire</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenu de l'histoire</label>
                    <textarea id="content" name="content" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image_url">URL de l'image (optionnel)</label>
                    <input type="text" id="image_url" name="image_url">
                </div>
                <button type="submit">Ajouter l'histoire</button>
            </form>
        </div>

        <div class="stories-list">
            @foreach($stories as $story)
                <div class="story-card">
                    <h3>{{ $story->title }}</h3>
                    <p>{{ $story->content }}</p>
                    @if($story->image_url)
                        <img src="{{ $story->image_url }}" alt="{{ $story->title }}" style="max-width: 100%; border-radius: 10px;">
                    @endif
                    <div style="margin-top: 15px;">
                        <a href="{{ route('stories.edit', $story->id) }}" class="edit-btn">Modifier</a>
                        <form action="{{ route('stories.destroy', $story->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette histoire?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html> 