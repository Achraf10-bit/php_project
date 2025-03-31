<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        $media = Media::with('category')->get();
        return view('admin.dashboard', compact('categories', 'media'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Category::create($request->all());
        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($request->all());
        return redirect()->back()->with('success', 'Catégorie mise à jour avec succès');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée avec succès');
    }

    public function storeMedia(Request $request)
    {
        $request->validate([
            'type' => 'required|in:image,audio,video',
            'category_id' => 'required|exists:categories,id',
            'media_file' => 'required|file|max:102400', // 100MB max
            'description' => 'nullable|string'
        ]);

        $file = $request->file('media_file');
        $path = $file->store('public/media');
        
        Media::create([
            'type' => $request->type,
            'category_id' => $request->category_id,
            'file_path' => str_replace('public/', '', $path),
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Média ajouté avec succès');
    }

    public function destroyMedia(Media $media)
    {
        if ($media->file_path) {
            Storage::delete('public/' . $media->file_path);
        }
        $media->delete();
        return redirect()->back()->with('success', 'Média supprimé avec succès');
    }
}
