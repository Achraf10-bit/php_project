<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('name', 'Nombres et Chiffres')
            ->with(['media' => function($query) {
                $query->with('quizzes');
            }])
            ->first();
        
        if (!$categories) {
            return view('home', ['categories' => collect([])]);
        }

        return view('home', ['categories' => collect([$categories])]);
    }

    public function numbers()
    {
        $categories = Category::where('name', 'Nombres et Chiffres')
            ->with(['media' => function($query) {
                $query->with('quizzes');
            }])
            ->first();
        
        if (!$categories) {
            return view('numbers', ['categories' => collect([])]);
        }

        return view('numbers', ['categories' => collect([$categories])]);
    }
}
