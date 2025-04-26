<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Animal</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f9ff;
            color: #333;
        }
        .container {
            max-width: 800px;
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
        .edit-form {
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
        .btn-secondary {
            background-color: #ff4081;
        }
        .btn-secondary:hover {
            background-color: #f50057;
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
        .preview-image {
            max-width: 200px;
            margin: 10px 0;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('animals.index') }}" class="back-link">← Retour à la liste</a>
        
        <div class="header">
            <h1>Modifier l'Animal</h1>
        </div>

        <div class="edit-form">
            <form action="{{ route('animals.update', $animal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nom de l'animal</label>
                    <input type="text" id="name" name="name" value="{{ $animal->name }}" required>
                </div>

                <div class="form-group">
                    <label for="image_url">URL de l'image</label>
                    <input type="text" id="image_url" name="image_url" value="{{ $animal->image_url }}" required>
                    <img src="{{ $animal->image_url }}" alt="{{ $animal->name }}" class="preview-image">
                </div>

                <div class="form-group">
                    <label for="sound_url">URL du son</label>
                    <input type="text" id="sound_url" name="sound_url" value="{{ $animal->sound_url }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description (optionnel)</label>
                    <textarea id="description" name="description">{{ $animal->description }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Enregistrer les modifications</button>
                    <a href="{{ route('animals.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 