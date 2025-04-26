<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlphabetGameController extends Controller
{
    public function index()
    {
        // French alphabet
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
                     'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        
        // French words that start with each letter
        $wordExamples = [
            'A' => 'Avion', 'B' => 'Banane', 'C' => 'Chat', 'D' => 'Dauphin', 'E' => 'Éléphant',
            'F' => 'Fleur', 'G' => 'Girafe', 'H' => 'Hibou', 'I' => 'Igloo', 'J' => 'Jaguar',
            'K' => 'Kangourou', 'L' => 'Lion', 'M' => 'Maison', 'N' => 'Nuage', 'O' => 'Orange',
            'P' => 'Pomme', 'Q' => 'Question', 'R' => 'Robot', 'S' => 'Soleil', 'T' => 'Tigre',
            'U' => 'Univers', 'V' => 'Voiture', 'W' => 'Wagon', 'X' => 'Xylophone', 'Y' => 'Yoga',
            'Z' => 'Zèbre'
        ];
        
        // Select a random letter
        $letter = $alphabet[array_rand($alphabet)];
        
        // Get a word example for the selected letter
        $wordExample = $wordExamples[$letter];
        
        // Create options (3 random letters + the correct one)
        $options = [$letter];
        $availableLetters = array_diff($alphabet, [$letter]);
        
        // Add 3 more random letters
        for ($i = 0; $i < 3; $i++) {
            $randomIndex = array_rand($availableLetters);
            $options[] = $availableLetters[$randomIndex];
            unset($availableLetters[$randomIndex]);
        }
        
        // Shuffle the options
        shuffle($options);
        
        return view('alphabet.index', compact('letter', 'wordExample', 'options'));
    }
}
