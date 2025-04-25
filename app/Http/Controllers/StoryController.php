<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::latest()->get();
        return view('stories.index', compact('stories'));
    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image_url' => 'nullable|url'
        ]);

        Story::create($request->all());
        return redirect()->route('stories.index')->with('success', 'Histoire ajoutée avec succès!');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $story = Story::findOrFail($id);
        return view('stories.edit', compact('story'));
    }


    public function update(Request $request, string $id)
    {
        $story = Story::findOrFail($id);
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image_url' => 'nullable|url'
        ]);

        $story->update($request->all());
        return redirect()->route('stories.index')->with('success', 'Histoire modifiée avec succès!');
    }

    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index')->with('success', 'Histoire supprimée avec succès!');
    }
}
