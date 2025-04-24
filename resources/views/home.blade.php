<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monde Amusant des Enfants</title>
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
            text-align: center;
        }
        .header {
            background-color:rgb(0, 186, 243);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: blue;
            font-size: 3em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .welcome {
            font-size: 1.5em;
            color: #666;
            margin: 20px 0;
        }
        .section {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .title {
            color: #4caf50;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #fff9c4;
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card h3 {
            color: #ff9800;
            margin-bottom: 10px;
        }
        .card p {
            color: #666;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌟 Bienvenue dans le Monde Amusant! 🌟</h1>
            <p class="welcome">Où l'apprentissage rencontre le plaisir!</p>
        </div>

        <div class="section">
            <h2 class="title">🎮 Activités Amusantes</h2>
            <div class="content">
                <div class="card">
                    <h3>📚 Histoires</h3>
                    <p>Lisez des histoires passionnantes!</p>
                    <a href="{{ route('stories.index') }}" style="display: inline-block; margin-top: 10px; color: #ff4081; text-decoration: none;">Voir les histoires →</a>
                </div>
                <div class="card">
                    <h3>🦊Carte d'animaux</h3>
                    <p>Decouvrez les animaux de la planète</p>
                    <a href="" style="display: inline-block; margin-top: 10px; color: #ff4081; text-decoration: none;">Voir les animaux →</a>
                </div>
                
            </div>
        </div>

        <div class="section">
            <h2 class="title">🎯 Jeux Éducatifs</h2>
            <div class="content">
                <div class="card">
                    <h3>🔢 Jeux de Maths</h3>
                    <p>Apprenez les nombres en vous amusant!</p>
                    <a href="" style="display: inline-block; margin-top: 10px; color: #ff4081; text-decoration: none;">Jouer aux maths →</a>
                </div>
                <div class="card">
                    <h3>🔤 Jeux de l'Alphabet</h3>
                    <p>Apprenez l'alphabet en vous amusant!</p>
                    <a href="" style="display: inline-block; margin-top: 10px; color: #ff4081; text-decoration: none;">Jouer à l'alphabet →</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>