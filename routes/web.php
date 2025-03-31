<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('accueil');
})->name('home');

Route::get('/numbers', [App\Http\Controllers\HomeController::class, 'numbers'])->name('numbers');
Route::get('/memory', function () {
    return view('memory');
})->name('memory');

Route::get('/math', function () {
    return view('math');
})->name('math');

Route::get('/colors', function () {
    return view('colors');
})->name('colors');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::resource('categories', CategoryController::class);
Route::resource('media', MediaController::class);

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Category management
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Media management
    Route::post('/media', [AdminController::class, 'storeMedia'])->name('media.store');
    Route::delete('/media/{media}', [AdminController::class, 'destroyMedia'])->name('media.destroy');
});

require __DIR__.'/auth.php';
