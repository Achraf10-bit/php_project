<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('icon');
            $table->integer('points_required');
            $table->timestamps();
        });

        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->integer('total_points')->default(0);
            $table->json('completed_categories')->nullable();
            $table->json('earned_badges')->nullable();
            $table->timestamps();
        });

        Schema::create('leaderboard', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->integer('score');
            $table->timestamps();
        });

        Schema::create('memory_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->json('cards');
            $table->timestamps();
        });

        Schema::create('drag_drop_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->json('items');
            $table->json('targets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drag_drop_exercises');
        Schema::dropIfExists('memory_games');
        Schema::dropIfExists('leaderboard');
        Schema::dropIfExists('user_progress');
        Schema::dropIfExists('badges');
    }
};
