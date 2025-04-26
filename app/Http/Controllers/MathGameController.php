<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MathGameController extends Controller
{
    public function index()
    {
        // Generate random numbers between 1 and 10 for the addition game
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        
        return view('math.index', compact('num1', 'num2'));
    }
}
