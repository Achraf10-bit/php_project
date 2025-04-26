<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux de l'Alphabet</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f9ff;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #9c27b0;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: white;
            margin: 0;
            font-size: 2.5em;
        }
        .game-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .letter-display {
            font-size: 8em;
            margin: 20px 0;
            color: #9c27b0;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.1);
        }
        .letter-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .letter-option {
            width: 60px;
            height: 60px;
            background-color: #e1bee7;
            border: none;
            border-radius: 50%;
            font-size: 2em;
            color: #4a148c;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .letter-option:hover {
            background-color: #ce93d8;
            transform: scale(1.1);
        }
        .letter-option.correct {
            background-color: #4caf50;
            color: white;
        }
        .letter-option.incorrect {
            background-color: #f44336;
            color: white;
        }
        .result {
            font-size: 1.5em;
            margin: 20px 0;
            padding: 15px;
            border-radius: 10px;
        }
        .correct {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .incorrect {
            background-color: #f2dede;
            color: #a94442;
        }
        .score {
            font-size: 1.5em;
            margin: 20px 0;
            color: #9c27b0;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
            font-size: 1.2em;
        }
        .back-link:hover {
            color: #9c27b0;
        }
        .new-game-btn {
            background-color: #9c27b0;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.5em;
            cursor: pointer;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 10px 0;
        }
        .new-game-btn:hover {
            background-color: #7b1fa2;
        }
        .word-example {
            font-size: 1.5em;
            margin: 20px 0;
            color: #666;
        }
        .word-example span {
            color: #9c27b0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Retour à l'accueil</a>
        
        <div class="header">
            <h1>🔤 Jeux de l'Alphabet</h1>
        </div>

        <div class="game-container">
            <h2>Reconnaître les Lettres</h2>
            <p>Trouvez la lettre <span id="current-letter">{{ $letter }}</span>:</p>
            
            <div class="letter-display">{{ $letter }}</div>
            
            <div class="word-example">
                Exemple: <span id="word-example">{{ $wordExample }}</span>
            </div>
            
            <div class="letter-options">
                @foreach($options as $option)
                    <button class="letter-option" data-letter="{{ $option }}">{{ strtolower($option) }}</button>
                @endforeach
            </div>
            
            <div id="result" class="result" style="display: none;"></div>
            
            <div class="score">
                Score: <span id="score">0</span>
            </div>
            
            <button id="new-game" class="new-game-btn">Nouvelle Lettre</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const letterOptions = document.querySelectorAll('.letter-option');
            const resultDiv = document.getElementById('result');
            const scoreSpan = document.getElementById('score');
            const newGameBtn = document.getElementById('new-game');
            const currentLetter = document.getElementById('current-letter').textContent;
            let score = 0;
            
            letterOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const selectedLetter = this.getAttribute('data-letter');
                    
                    if (selectedLetter === currentLetter) {
                        this.classList.add('correct');
                        resultDiv.textContent = '🎉 Correct! Très bien! 🎉';
                        resultDiv.className = 'result correct';
                        score += 10;
                    } else {
                        this.classList.add('incorrect');
                        resultDiv.textContent = '❌ Incorrect. Essayez encore!';
                        resultDiv.className = 'result incorrect';
                    }
                    
                    resultDiv.style.display = 'block';
                    scoreSpan.textContent = score;
                    
                    // Disable all buttons after an answer
                    letterOptions.forEach(btn => {
                        btn.disabled = true;
                    });
                });
            });
            
            newGameBtn.addEventListener('click', function() {
                // Reload the page to get a new letter
                window.location.reload();
            });
        });
    </script>
</body>
</html> 