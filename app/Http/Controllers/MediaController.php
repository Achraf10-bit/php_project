<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::with('category')->get();

        return view('media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('media.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:image,audio,video',
            'file' => 'required|file',
        ]);

        $filePath = $request->file('file')->store('uploads', 'public');

        Media::create([
            'category_id' => $request->category_id,
            'type' => $request->type,
            'file_path' => $filePath,
        ]);

        return redirect()->route('media.index')->with('success', 'Media uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully!');
    }
}
