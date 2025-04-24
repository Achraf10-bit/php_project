<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;

Route::get('/', function () {
    return view('home');
});

Route::resource('stories', StoryController::class);

