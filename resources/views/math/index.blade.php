<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux de Maths</title>
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
            background-color: #ff9800;
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
        .problem {
            font-size: 3em;
            margin: 20px 0;
            color: #333;
        }
        .answer-input {
            font-size: 2em;
            width: 100px;
            padding: 10px;
            text-align: center;
            border: 3px solid #4caf50;
            border-radius: 10px;
            margin: 20px 0;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        .submit-btn {
            background-color: #4caf50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.5em;
            cursor: pointer;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 10px 0;
        }
        .submit-btn:hover {
            background-color: #45a049;
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
            color: #ff9800;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
            font-size: 1.2em;
        }
        .back-link:hover {
            color: #ff9800;
        }
        .new-game-btn {
            background-color: #ff9800;
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
            background-color: #f57c00;
        }
        .emoji {
            font-size: 2em;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Retour à l'accueil</a>
        
        <div class="header">
            <h1>🔢 Jeux de Maths</h1>
        </div>

        <div class="game-container">
            <h2>Addition Simple</h2>
            <p>Répondez à l'addition ci-dessous:</p>
            
            <div class="problem">
                <span id="num1">{{ $num1 }}</span> + <span id="num2">{{ $num2 }}</span> = ?
            </div>
            
            <form id="answer-form">
                <input type="number" class="answer-input" id="answer" placeholder="?" required>
                <br>
                <button type="submit" class="submit-btn">Vérifier</button>
            </form>
            
            <div id="result" class="result" style="display: none;"></div>
            
            <div class="score">
                Score: <span id="score">0</span>
            </div>
            
            <button id="new-game" class="new-game-btn">Nouvelle Question</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const answerForm = document.getElementById('answer-form');
            const resultDiv = document.getElementById('result');
            const scoreSpan = document.getElementById('score');
            const newGameBtn = document.getElementById('new-game');
            let score = 0;
            let correctAnswer;
            
            function updateCorrectAnswer() {
                const num1 = parseInt(document.getElementById('num1').textContent);
                const num2 = parseInt(document.getElementById('num2').textContent);
                correctAnswer = num1 + num2;
            }
            
            updateCorrectAnswer();
            
            answerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const userAnswer = parseInt(document.getElementById('answer').value);
                
                if (userAnswer === correctAnswer) {
                    resultDiv.textContent = '🎉 Correct! Très bien! 🎉';
                    resultDiv.className = 'result correct';
                    score += 10;
                } else {
                    resultDiv.textContent = '❌ Incorrect. La réponse est ' + correctAnswer;
                    resultDiv.className = 'result incorrect';
                }
                
                resultDiv.style.display = 'block';
                scoreSpan.textContent = score;
            });
            
            newGameBtn.addEventListener('click', function() {
                const newNum1 = Math.floor(Math.random() * 10) + 1;
                const newNum2 = Math.floor(Math.random() * 10) + 1;
                
                document.getElementById('num1').textContent = newNum1;
                document.getElementById('num2').textContent = newNum2;
                document.getElementById('answer').value = '';
                resultDiv.style.display = 'none';
                updateCorrectAnswer();
            });
        });
    </script>
</body>
</html> 