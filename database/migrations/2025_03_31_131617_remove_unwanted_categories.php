<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categoriesToDelete = [
            'Animaux Mignons',
            'Formes et Motifs',
            'Lettres et Chiffres',
            'Art et Illustrations',
        ];

        // Delete associated media first
        DB::table('media')
            ->join('categories', 'media.category_id', '=', 'categories.id')
            ->whereIn('categories.name', $categoriesToDelete)
            ->delete();

        // Then delete the categories
        DB::table('categories')
            ->whereIn('name', $categoriesToDelete)
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need for down migration as we're removing unwanted data
    }
};
