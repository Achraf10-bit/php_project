<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return view('animals.index', compact('animals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image_url' => 'required|url',
            'sound_url' => 'required|url',
            'description' => 'nullable|string'
        ]);

        Animal::create($request->all());
        return redirect()->route('animals.index')->with('success', 'Animal ajouté avec succès!');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animals.index')->with('success', 'Animal supprimé avec succès!');
    }

    public function edit(Animal $animal)
    {
        return view('animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image_url' => 'required|url',
            'sound_url' => 'required|url',
            'description' => 'nullable|string'
        ]);

        $animal->update($request->all());
        return redirect()->route('animals.index')->with('success', 'Animal modifié avec succès!');
    }
}
