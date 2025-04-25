<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Histoire</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f9ff;
            color: #333;
        }
        .main {
            max-width: 800px;
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
        .edit {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .gr {
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
        .btn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn2 {
            background-color: #ff4081;
        }
        .btn2:hover {
            background-color: #f50057;
        }
        .link_b {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
        }
        .link_b:hover {
            color: #ff4081;
        }
    </style>
</head>
<body>
    <div class="main">
        <a href="{{ route('stories.index') }}" class="link_b">← Retour à la liste</a>
        
        <div class="header">
            <h1>Modifier l'Histoire</h1>
        </div>

        <div class="edit">
            <form action="{{ route('stories.update', $story->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="gr">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" value="{{ $story->title }}" required>
                </div>

                <div class="gr">
                    <label for="content">Contenu</label>
                    <textarea id="content" name="content" required>{{ $story->content }}</textarea>
                </div>

                <div class="gr">
                    <label for="image_url">URL de l'image (optionnel)</label>
                    <input type="text" id="image_url" name="image_url" value="{{ $story->image_url }}">
                </div>

                <div class="gr">
                    <button type="submit" class="btn">Enregistrer les modifications</button>
                    <a href="{{ route('stories.index') }}" class="btn btn2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 